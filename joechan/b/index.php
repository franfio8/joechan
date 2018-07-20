<!DOCTYPE html>
<?php
  session_start();
  include '../config/db_connect.php';
?>


<HTML>
		<head>
			<title>Random</title>
			<link rel="stylesheet" href="../css/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
      </script>
      <script>
      $(function(){
        $('.op_img').click(function(){
          $(this).toggleClass('on');
          $(this).closest('.thread').toggleClass('on');
        });
      });
      </script>


		</head>

    <body>

    <div class="parallax"></div>

		<div class="nav">
			<a href="/joechan/">Home</a>
			<a href="/joechan/b">Random</a>
			<a href="/joechan/g">Technology</a>
			<a href="/joechan/phi">Philosophy</a>
			<a href="/joechan/phi">DIY</a>
			<a href="/joechan/phi">Photography</a>
			<a href="/joechan/phi">Politics</a>
			<a href="/joechan/phi">Video Games</a>
			<a href="/joechan/phi">Science</a>
			<a href="/joechan/phi">Comfy</a>
		</div>

	<h1>Random</h1>

	<center>
		<!-- <img class="banner" src="./images/banner.gif">-->

    <!-- Trigger/Open The Modal -->
<button class="btn" id="myBtn">Make a Thread</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

    <div class="form_title">Create a Thread</div>

    <div class="post_thread">
      <form action="upload.php" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <th>Title</th>
        <td><input type="text" name="title" value=""></td>
      </tr>
      <tr>
        <th>Comment</th>
        <td><textarea type="text" name="comment" value=""></textarea></td>
      </tr>
      <tr>
        <th>File:</th>
        <td><input class="file" type="file" name="fileToUpload" id="fileToUpload"></td>
      </tr>
    </table>
        <input class="post" type="submit" value="POST" name="submit">
      </form>
    </div>

  </div>

</div>


	</center>

  <div class = "thread">
    <div class = "op-image">
      <p class = "file_info">File:</p>
      <a href="./images/comfy1.jpg">
      </a>
      <img class = "op_img" src="./images/comfy1.jpg">
    </div>
    <div class = "post_info">
      <p class="intro">
        <label>
          <span class="title">Sticky</span>
          <span class="username">Joe</span>
          <span class = "thread_id">0</span>
          <span class = "time">All the time</span>
        </label>
      </p>
      <div class="body">
        This is the random board where anyone can post whatever they please.
      </div>
    </div>
    <div class="view_button"><a href="./threads/<?php echo "hey sup";?>">[view]</a></div>
  </div>

  <?php
      $sql = "SELECT * FROM threads";
      $sql2 = "SELECT users.username, threads.thread_op_image, threads.thread_op_text, threads.thread_title, threads.thread_id, threads.thread_time
      FROM threads, users
      WHERE threads.thread_user_id = users.user_id
      ORDER BY thread_id";

      $result = mysqli_query($link, $sql2);
      $num_rows = mysqli_num_rows($result);

      while ($row = mysqli_fetch_assoc($result))
      {
        echo
        "
        <div class = \"thread\">
          <div class = \"op-image\">
            <p class = \"file_info\">File: ". $row['thread_op_image'] ."</p>
            <a href=\"./images/comfy1.jpg\">
            </a>
            <img class = \"op_img\" src=\"./uploads/". $row['thread_op_image'] ."\">
          </div>
          <div class = \"post_info\">
            <p class=\"intro\">
              <label>
                <span class=\"title\">". $row['thread_title'] ."</span>
                <span class=\"username\">". $row['username'] ."</span>
                <span class = \"thread_id\">". $row['thread_id'] ."</span>
                <span class = \"time\">". $row['thread_time'] ."</span>
              </label>
            </p>
            <div class=\"body\">
              ". $row['thread_op_text'] ."
            </div>
          </div>
          <div class=\"view_button\"><a href=\"./threads/". $row['thread_id'] . ".php\">[view]</a></div>
        </div>
        ";
      }
  ?>



  <footer class="footer">Copyright &#169; <?php echo date("Y"); ?> Boson Inc.</footer>

</body>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>



</HTML>
