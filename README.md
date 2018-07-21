# joechan
An independently created imageboard using php and mysql.

The only working board at the moment is random (b), however you can easily replicate the b-directory into whatever board you please. All you would have to do is change a bit of the html to customise it to the relevant board.

The site uses plain php, no frameworks.

The mysql databse is comprised of four related tables; boards, threads, replies and users. 
The users table contains 2 users; the admin and anonymous. you can easily create more users, implementing a simple sign-up form and using sessions to provide features such as global moderation, editing stickys, deleting own posts, getting thread updates and so on.

Current features:
  -Create threads
  -Reply to threads
  -Post images
  -click to enlarge images
  -Admin user login

Future developments:
  -Change thread display hierarchy
  -Create, login and post using personal username
  -Edit posts you made when logged in
  -Send thread update notifications
  -Radio
  -video posting
  -Convert posted images to thumbnails for faster loading times
  -Image elarges to original size
  -Password encryption
