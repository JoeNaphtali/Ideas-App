                    <?php 

                    // If user clicks the 'Read More' link
					if(isset($_GET['i_id'])){

						$idea_id = $_GET['i_id'];

					}

                    // Select all ideas for the 'idea' table
					$results = mysqli_query($conn, "SELECT * FROM idea WHERE id=$idea_id");

					while ($row = mysqli_fetch_array($results)) { 
						
					?>

                    <!-- Title -->
                    
                    <h1 class="mt-4"><?php echo $row['idea_title']; ?></h1>

                    <!-- /.Title -->

                    <!-- Author -->
                    
					<p class="lead">
                    Proposed by
                    <?php                   
                    $user_id = $row['user__id'];
                    // Retrieve user from 'user' table
                    $user_result = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
                    while ($row2 = mysqli_fetch_array($user_result)) {                    
                    ?>
					<a href="user.php?u_id=<?php echo $row2["id"]; ?>">
                        <?php 
                        // Concatenate user firstname and lastname into 'author' variable and display author name
                        $author = $row2['first_name'] . ' ' . $row2['last_name'];
                        echo $author;
                        ?>
                    </a>
                    </p>
                    <!-- Close While loop -->
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
					<a href="category.php?c_id=<?php echo $row1['id']; ?>"><?php echo $row1['category_name']; ?></a>
                    </p>
                    <!-- Closing While loop -->
                    <?php } ?>
                    
                    <!-- /.Category -->

                    <!-- Date -->
                    
                    <p>On <?php echo $row['post_date']; ?> </p>
                    
                    <!-- /.Date -->

		            <hr>

                    <!-- Idea Content -->
                    
                    <?php echo $row['content']; ?>

                    <!-- /.Idea Content -->

					<!-- Closing While loop -->
                    <?php } ?>

                    <hr>
                    
                    <!-- Vote count -->

                    <div class="votes">
                        
                        <!-- Fill button icon if user likes idea, otherwise outline button icon -->
                        <i <?php if (userLiked($idea_id)): ?>
                            class="material-icons like-btn"
                        <?php else: ?>
                            class="material-icons-outlined like-btn"
                        <?php endif ?>
                        data-id="<?php echo $idea_id ?>" style="cursor: pointer; color:blue;">thumb_up</i>
                        <span class="likes" style="font-size: 24px; color:blue;">
                            <?php echo getLikes($idea_id); ?>
                        </span>
                        
                        <!-- No breaking space between like and dislike buttons -->
                        &nbsp;&nbsp;&nbsp;&nbsp;

                        <!-- Fill button icon if user likes idea, otherwise outline button icon -->
                        <i <?php if (userDisliked($idea_id)): ?>
                            class="material-icons dislike-btn"
                        <?php else: ?>
                            class="material-icons-outlined dislike-btn"
                        <?php endif ?>
                        data-id="<?php echo $idea_id ?>" style="cursor: pointer; color:red;">thumb_down</i>
                        <span class="dislikes" style="font-size: 24px; color:red;">
                            <?php echo getDislikes($idea_id); ?>
                        </span>

                    </div>

                    <!-- /.Vote count -->