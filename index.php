<?php
$data = array(
  'app'=>array(
    'name'=>'Uploader',
    'start_time'=>microtime(true),
    'version'=>'0.1',
    'path'=>'uploader.chrismacnaughton.com'
  ),
  'errors'=>array(),
  'flash'=>array(),
  'post'=>$_POST,
  'files'=>$_FILES,
  'file'=>(isset($_FILES['file']))?$_FILES['file']:array()
);
require_once 'functions.php';
require_once('vendor/autoload.php');
require_once('config.php');

$s3 = new AmazonS3($options); //bucket name: cm-uploads
$db = new PDO($dsn, $user, $dbpass);

$path = (isset($_SERVER['PATH_INFO']))?trim($_SERVER['PATH_INFO'],'/'):'';

if($path == ''){
  //index - upload stuff
  if(isset($_POST['action']) && $_POST['action'] == 'upload'){
    if($_POST['password']=='' OR $_FILES['file']['error'] == 4){
      if($_POST['password']=='')
        $data['errors']['password']="No password specified, password is required";
      if($_FILES['file']['error'] == 4)
        $data['errors']['file']="No file selected to upload";
    }
    if(!empty($data['errors'])){
      echo render('upload.html.twig', $data);
      exit;
    }
    $password = $_POST['password'];
    $path = ($_POST['path'] != '')?$_POST['path']:substr(hash('sha512',rand(0,10000) . microtime()), 5, 8);
    $stmt = $db->prepare("SELECT count(*) AS count FROM files WHERE 'path' = :path");
    $res['count'] = 1;
    $stmt->execute(array(':path'=>$path));
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    while($res['count'] != 0){
      $stmt->execute(array(':path'=>$path));
      $res = $stmt->fetch(PDO::FETCH_ASSOC);
      $path = substr(hash('sha512',rand(0,10000) . microtime()), 5, 8);
    }
    $file = $_FILES['file'];
    $tmp = explode('.',$file['name']);
    $file['extension'] = $tmp[count($tmp)-1];
    //unset($data['files']);

    set_time_limit(0);
    //$iv = substr(md5('iv'.$password, true), 0, 8);
    $key = base64_encode(substr(md5($pass1.$password, true) .
                   md5($pass2.$password, true), 0, 24));
    //$opts = array('iv'=>$iv, 'key'=>$key);
    exec("openssl enc -aes256 -e -in ".$file['tmp_name'] ." -out ".'./tmp/'.$file['name']." -k ".$key);
    /*
    $f = fopen($file['tmp_name'], 'r');
    $filedata = json_encode(array(
      'pw_hash'=>hash('sha512', $password),
      'extension'=>$file['extension'],
      'file'=>base64_encode(fread($f, filesize($file['tmp_name'])))
    ));
    $fp = fopen('./tmp/'.$file['name'], 'wb');
    stream_filter_append($fp, 'mcrypt.tripledes', STREAM_FILTER_WRITE, $opts);
    fwrite($fp, $filedata);
    fclose($fp);
    */
    $name = sha1($file['name'] . microtime());

    $result = $s3->create_object($bucket, $name, array(
      'fileUpload'=>'./tmp/'.$file['name'],
    ));
    set_time_limit(90);
    // Success?
    if($result->isOK()){
      $file = array(
        ':name'=>$name,
        ':path'=>$path,
        ':ext'=>$file['extension'],
        ':hash'=>hash('sha512', $password),
        ':expires'=>time() + 7 * 24 * 60 * 60
      );
      $stmt = $db->prepare("INSERT INTO files (file, `path`, expires, hash, ext) VALUES (:name, :path, :expires, :hash, :ext)");
      $stmt->execute($file);
      $err = $db->errorInfo();
      if($err[0] == 00000){
        $data['flash'][] = "Success uploading your file! It will be available at /".$file[':path']." until ".date('M d, Y', $file[':expires']);
      } else {
        $data['errors'][]=$err[1];
      }
    } else {
      echo"<!--";print_r($result);echo"-->";
    }
    unlink('./tmp/'.$data['file']['name']);
  }
  $data['name'] = "Upload";
  echo render('upload.html.twig', $data);
  exit;
} else {
  //download link
  $stmt = $db->prepare("SELECT * FROM files WHERE `path` = :path AND `expires` > :time");
  $stmt->execute(array(':path'=>$path, ':time'=>time()));

  $file = $stmt->fetch(PDO::FETCH_ASSOC);
  if(empty($file)){
    $data['errors'][] = "Invalid path specified";
    echo render("errors.html.twig", $data);
    exit;
  }

  if(isset($_POST['action']) && $_POST['action'] == 'download'){
    if($_POST['password'] == ''){
      $data['errors'][]="No password specified, password is required";
    }
    if(!empty($data['errors'])){
      echo render('download.html.twig', $data);
      exit;
    }
    $passphrase = $_POST['password'];
    $data['file'] = $file;
    set_time_limit(0);
    $response = $s3->get_object($bucket, $file['file']);
    $data['response'] = $response;
    if($response->isOK()){
      $f=fopen('./tmp/'.$file['file'], 'w');
      fwrite($f,$response->body);
      fclose($f);
    } else {
      render('errors.html.twig', $data, 503);
      exit();
    }
    //$iv = substr(md5('iv'.$passphrase, true), 0, 8);
    $key = base64_encode(substr(md5($pass1.$passphrase, true) .
                   md5($pass2.$passphrase, true), 0, 24));
    /*
    $opts = array('iv'=>$iv, 'key'=>$key);

    $fp = fopen('./tmp/'.$file['file'], 'rb');
    stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
    $file_data = rtrim(stream_get_contents($fp));
    fclose($fp);

    */
    if(hash('sha512', $passphrase) != $file['hash']){
      $data['errors'][]="Invalid password, could not decrypt file";
      echo render('download.html.twig', $data, 403);
      unlink('./tmp/'.$file['file']);
      exit;
    }
    $rand = './tmp/'.substr(sha1(rand(1,1000). microtime() . microtime(true)),0,15);
    $str = "openssl enc -aes256 -d -in ".'./tmp/'.$file['file']." -out ".$rand ." -k ".$key;

    exec($str);

    unlink('./tmp/'.$file['file']);


    $extension = $file['ext'];
    //echo $content_type;exit;
    // fix for IE catching or PHP bug issue
    header("Pragma: public");
    header("Expires: 0"); // set expiration time
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // browser must download file from server instead of cache

    // force download dialog
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-length:".filesize($rand));
    header('Content-Disposition: attachment; filename="downloaded.'.$extension.'"');
    $f = fopen($rand, 'r');

    while(!feof($f)){
      echo fread($f, 1024);
      ob_flush();
    }
    //echo base64_decode($file_data['file']);
    unlink($rand);
    exit;
  }
  $data['name'] = "Download";
  echo render('download.html.twig', $data);
}
//print_r($_SERVER);