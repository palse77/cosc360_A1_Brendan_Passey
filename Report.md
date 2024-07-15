In general following along with the lecture material made this a straight forward and rather enjoyable process. 

I did however get stumped by an issue for a couple of hours where my flash messages on the index view were appearing as links to the highest ID blog post.
I finally discovered this was because I failed to close my <a tag in my for each loop causing the subsequent content on the page to be rendered as part of 
the link to the last blog post on the list. 