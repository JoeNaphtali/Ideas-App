                    <?php 

                    // If user clicks the 'Read More' link
					if(isset($_GET['i_id'])){

                        $idea_id = $_GET['i_id'];
                        // Increase page view count by 1 when user accesses specific idea page
                        mysqli_query($conn, "UPDATE idea SET view_count = view_count + 1 WHERE id=$idea_id");

                    }
                    
                    // Select idea from the 'idea' table
                    $results = mysqli_query($conn, "SELECT * FROM idea WHERE id=$idea_id");

					while ($row = mysqli_fetch_array($results)) { 
						
					?>

                    <!-- Title -->
                    
                    <?php $idea_title = $row['idea_title']; ?>
                    <h1 class="mt-4" style="font-weight: bold;"><?php echo $row['idea_title']; ?></h1>

                    <!-- /.Title -->

                    <!-- Author -->
                    
					<p class="lead">
                    Proposed by
                    <?php
                    $user_id = $row['user__id'];
                    // If user proposed idea anonymously display author as 'Anonymous'
                    if ($row['anonymous'] == true) { 
                    ?>                       
                        Anonymous
                        <?php } else { ?>
                        <?php                   
                        // Retrieve user from 'user' table
                        $user_result = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
                        while ($row2 = mysqli_fetch_array($user_result)) {                    
                        ?>
                        <a href="index.php?u_id=<?php echo $row2["id"]; ?>">
                            <?php 
                            // Concatenate user firstname and lastname into 'author' variable and display author name
                            $author = $row2['first_name'] . ' ' . $row2['last_name'];
                            echo $author;
                            ?>
                        </a>
                        </p>
                        <!-- Close While loop -->
                        <?php } ?>
                    <!-- Closing If statement -->
                    <?php } ?>

                    <!-- /.Author -->

                    <!-- Category -->

                    <p>
                    <?php                   
                    $category_id = $row['category_id'];
                    // Retrieve catergory name from 'category' table
                    $category_result = mysqli_query($conn, "SELECT * FROM category WHERE id=$category_id");
                    while ($row1 = mysqli_fetch_array($category_result)) {                    
                    ?>
					Category:
					<a href="index.php?c_id=<?php echo $row1['id']; ?>"><?php echo $row1['category_name']; ?></a>
                    </p>
                    <!-- Closing While loop -->
                    <?php } ?>
                    
                    <!-- /.Category -->

                    <!-- Date -->

                    <?php $time = new DateTime($row['post_date']);
                    $date = $time->format('F jS');
                    $time = $time->format('H:i'); ?>
                    
                    <p>Posted On <?php echo $date; ?> at <?php echo $time; ?> </p>
                    
                    <!-- /.Date -->

		            <hr>

                    <!-- Idea Content -->

                    <?php echo $row['content']; ?>

                    <!-- /.Idea Content -->

                    <!-- Idea Attachment -->

                    <?php 
                    
                    if (!empty($row['attachment'])) {

                        echo "<a href='attachments/".$row['attachment']."' target='_blank'>Attachment: ".$row['attachment']."</a>";

                    }

                    ?>

                    <!-- /.Idea Attachment -->

                    <hr>
                    
                    <!-- Vote count -->

                    <div class="votes">

                    <i class="fas fa-eye"></i>&nbsp;<?php echo $row['view_count'] ?>&nbsp;
                    <i class="fas fa-comment"></i>&nbsp;<?php echo $row['comment_count'] ?>&nbsp;
                        
                        <!-- Fill button icon if user likes idea, otherwise outline button icon -->
                        <i <?php if (userLiked($idea_id)): ?>
                            class="material-icons like-btn"
                        <?php else: ?>
                            class="material-icons-outlined like-btn"
                        <?php endif ?>
                        data-id="<?php echo $idea_id ?>" style="cursor: pointer; color:blue; font-size: 18px;">thumb_up</i>
                        <span class="likes" style="font-size: 18px; color:blue;">
                            <?php echo getLikes($idea_id); 
                            $likes = getLikes($idea_id);
                            $id = $idea_id;
                            mysqli_query($conn, "UPDATE idea SET upvote_count='$likes' WHERE id='$id'");
                            ?>
                        </span>
                        
                        <!-- No breaking space between like and dislike buttons -->
                        

                        <!-- Fill button icon if user likes idea, otherwise outline button icon -->
                        <i <?php if (userDisliked($idea_id)): ?>
                            class="material-icons dislike-btn"
                        <?php else: ?>
                            class="material-icons-outlined dislike-btn"
                        <?php endif ?>
                        data-id="<?php echo $idea_id ?>" style="cursor: pointer; color:red; font-size: 18px;">thumb_down</i>
                        <span class="dislikes" style="font-size: 18px; color:red;">
                            <?php echo getDislikes($idea_id); 
                            $dislikes = getDislikes($idea_id);
                            $id = $idea_id;
                            mysqli_query($conn, "UPDATE idea SET downvote_count='$dislikes' WHERE id='$id'");
                            ?>
                        </span>

                    </div>

                    <!-- /.Vote count -->

                    <!-- Closing While loop -->
                    <?php } ?>