<?php 
class comments
{
    public $id;
    public $post_id;
    public $user_id;
    public $comment_content;
    public $comment_date;
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
                $sql = "INSERT INTO comments (post_id,
                user_id,
                comment_content,
                comment_date)
            VALUES
            ('".$this->post_id."',
                '".$this->user_id."',
                '".$this->comment_content."',
                '".$this->comment_date."')";
            }
            else
            {
                $sql = "UPDATE user_accounts SET
                            post_id = '".$this->post_id."',
                            user_id = '".$this->user_id."',
                            comment_content ='".$this->comment_content."',
                            comment_date = '".$this->comment_date."'
                            WHERE
                            id = '".$this->id."',)";
            }

           mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
    }

function getAll()
{
    try
    {
        $sql = "SELECT * FROM comments";
        $result = mysqli_query($this->connDb, $sql) or die (mysqli_error(this->connDb));
        $result = mysqli_fetch_object($result);

        return $result;
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
        $sql = "SELECT * FROm comments WHERE id = '".$id."'";
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
        $sql = "DELETE FROM comments WHERE id = '".$id."'";
        mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
  }
}