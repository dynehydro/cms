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


function __construct($connDb)
{
    $this->connDb = $connDb;
}

function save()
{
    try
    {
        $sql = "";
        if (empty($this->id))
        {
            $sql = "INSERT INTO posts (post_type_id,
                        post_status_id,
                        post_title,
                        post_content,
                        post_date,
                        post_excerpt,
                        post_author_id)
                    VALUES (
                    '".$this->post_type_id."',
                    '".$this->post_status_id."',
                    '".$this->post_title."',
                    '".$this->post_content."',
                    '".$this->post_date."',
                    '".$this->post_excerpt."',
                    '".$this->post_author_id."')";

        }
        else
        {
            $sql = "UPDATE posts SET
                         post_type_id = '".$this->post_type_id."',
                         post_status_id = '".$this->post_status_id."'
                         post_title = '".$this->post_title."',
                         post_content = '".$this->post_content."',
                         post_date = '".$this->post_date."',
                         post excerpt = '".$this->post_excerpt."',
                         post_author_id = '".$this->post_author_id."'
                         WHERE
                         id = '".$this->id."'";
        }

        mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
    }
    catch (Exception $ex)
    {
        echo $ex->getMessage();
    }

}


  function getAll()
  {
    try
    {
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
        $result = mysqli_fetch_object($result);

        return $results;
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
  }

  function getSingle($id)
  {
    try
    {
        $sql = "SELECT * FROM posts WHERE id = '".$id."'";
        $result = mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
        $row = mysqli_fetch_row($result);

        return $row;
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
}

function delete($id)
{
    try
    {
        $sql = "DELETE FROM posts WHERE id = '".$id."'";
        mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
}

function myPosts($id)
{
    try
    {
        $sql = "SELECT * FROM posts WHERE post_author_id='".$id."'";
        $result = mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
        $result = mysqli_fetch_object($result);

        return $result;
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
  }
}

    
