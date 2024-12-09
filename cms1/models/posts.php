<?php
class Posts
{
    public $id;
    public $post_type_id;
    public $post_status_id;
    public $post_title;
    public $post_content;
    public $post_date;
    public $post_excerpt;
    public $post_author_id;

    private $connDb;

    // Constructor to initialize the database connection
    function __construct($connDb)
    {
        $this->connDb = $connDb;
    }

    // Save function to insert or update a post in the database
    function save()
    {
        try {
            $sql = "";

            // Check if the post ID is empty (insert a new post)
            if (empty($this->id)) {
                $sql = "INSERT INTO posts (post_type_id, post_status_id, post_title, post_content, post_date, post_excerpt, post_author_id) VALUES (" .
                       "'" . $this->post_type_id . "', " .
                       "'" . $this->post_status_id . "', " .
                       "'" . $this->post_title . "', " .
                       "'" . $this->post_content . "', " .
                       "'" . $this->post_date . "', " .
                       "'" . $this->post_excerpt . "', " .
                       "'" . $this->post_author_id . "');";
            } else {
                // Update an existing post if the post ID is not empty
                $sql = "UPDATE posts SET " .
                       "post_type_id = '" . $this->post_type_id . "', " .
                       "post_status_id = '" . $this->post_status_id . "', " .
                       "post_title = '" . $this->post_title . "', " .
                       "post_content = '" . $this->post_content . "', " .
                       "post_date = '" . $this->post_date . "', " .
                       "post_excerpt = '" . $this->post_excerpt . "', " .
                       "post_author_id = '" . $this->post_author_id . "' " .
                       "WHERE id = '" . $this->id . "';";

                // Execute the update query using mysqli
                if (!mysqli_query($this->connDb, $sql)) {
                    die(mysqli_error($this->connDb));
                }
            }

            // Execute the SQL query
            $stmt = $this->connDb->prepare($sql);
            $stmt->execute();
        } catch (Exception $ex) {
            // Handle exceptions (e.g., logging the error)
            echo $ex->getMessage();
        }
    }

    function getAll() {
        try {
            $sql = "SELECT * FROM posts";
            $query = mysqli_query($this->connDb, $sql) or die(mysqli_error($this->connDb));
            while ($result = mysqli_fetch_object($query)) {
                echo "<tr>";
                echo "<td>" . $result->post_title . "</td>";
                echo "<td align='center'>
                    <a href='new-post.php?action=edit&post_id=" . $result->id . "'>Edit</a> /
                    <a href='actions/posts_actions.php?action=delete&post_id=" . $result->id . "'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    // Get a single post by ID
    function getSingle($id)
    {
        try {
            $sql = "SELECT * FROM posts WHERE id = '" . $id . "'";
            $result = mysqli_query($this->connDb, $sql) or die(mysqli_error($this->connDb));
            $row = mysqli_fetch_row($result);
            return $row;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Delete a post by ID
    function delete($id)
    {
        try {
            $sql = "DELETE FROM posts WHERE id = '" . $id . "'";
            mysqli_query($this->connDb, $sql) or die(mysqli_error($this->connDb));
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Get posts by a specific author
    function myPosts()
    {
        try
        {
            $sql = "SELECT * FROM posts ORDER BY id DESC";
            $query = mysqli_query($this->connDb, $sql) or die(mysqli_error($this->connDb));
            while ($result = mysqli_fetch_object($query)) {
                echo "<tr><td>";
                echo $result->post_date . "<br>";
                echo $result->post_title . "</td>";
                echo "</tr>";
            }
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
}
