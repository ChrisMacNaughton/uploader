#Uploader

##What is Uploader
I created Uploader because I was curious about how hard it would be to create a system that would allow users to upload a file, encrypt the file before storing it, and decrypt that file on demand for download.

##How It Works
This system allows the user to upload a file and enter a password and then generates a key based on the password and uses OpenSSL to encrypt the file through the filesystem.

Going through the filesystem for encryption allows this system to run fairly well even on an AWS micro instance (like [Uploader][]).  Theoretically, this system can handle file uploads of up to 5GB; however, I haven't tested the encryption abilities of the AWS instance it's currently running on to identify the true maximum.

[Uploader]: http://uploader.chrismacnaughton.com