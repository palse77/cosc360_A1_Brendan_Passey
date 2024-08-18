https://github.com/palse77/cosc360_A1_Brendan_Passey

This is an improved blog application made to the specifications of assignment 2 cosc360.
Coded by Brendan Passey.
--------------------------------------------------------------------------------------

I worked on this for 12 hours straight today and to be honest it's been a bit of a blur. 
I did encounter some issues along the way including but not limited to:

Creating Middleware
Disallowing unauthorized access to the admin panel
At some point towards the end of the day the navbar became huge and ugly, I have no idea what happened, I've tinkered but I don't have time to fix it
A bug when trying to list users posts in the admin view concerning listing email addresses with null values
Routing admin and authors to different views for every action


My approach was to set this up in a way which seemed logical to me. Upon looking at the assessment specifications half an hour before submission 
deadline I realise I only created roles for admin and author. Even now I don't really see the distinction between a user and author.

Also looking at 8.b after the fact, I've allowed admin to make an author an admin if they see fit rather than
allowing someone to just sign up as an admin from the get go. Not sure it makes sense to allow anyone to sign up as an admin through
the registration process. 

I attempted to set up middleware at the very end, not sure if I managed it or not. Not really sure what the middleware is supposed to do
or how to check if it's working. But some combination of that and some auth->admin checks are restricting access to the admin controls. 

Factory, seeders and migrations exist in the project to create a number of fake users and posts with 1 being admin. 