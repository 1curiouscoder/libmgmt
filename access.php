<?php
require_once "connect.php";
$type = $_POST['type'];
if($type == "true"){
$sql = "SELECT * FROM accessrec WHERE active='true'";
$res = mysqli_query($conn,$sql);
if(empty(mysqli_error($conn)))
{
    if(mysqli_num_rows($res)>0)
    {
        $date1=date('Y-m-d');
    while($row = mysqli_fetch_assoc($res))
        {
            if(strtotime($date1) < strtotime($row['returndate']))
            {
            echo "<tr id='".$row['id']."' style='background-color:#00ffbf;'>
            <td placeholder='".$row['id']."'><input type='submit' class='return' value='Return' id='".$row['id']."'></td>
            <td>@".$row['accessid']."</td>
            <td>".$row['name']."</td>
            <td>".$row['bname']."</td>
            <td>".$row['issuedate']."</td>
            <td>".$row['returndate']."</td>
            </tr>
            ";
            }
            elseif(strtotime($date1) == strtotime($row['returndate']))
            {
                echo "<tr id='".$row['id']."' style='background-color:yellow;'>
                <td placeholder='".$row['id']."'><input type='submit' class='return' value='Return' id='".$row['id']."'></td>
                <td>@".$row['accessid']."</td>
                <td>".$row['name']."</td>
                <td>".$row['bname']."</td>
                <td>".$row['issuedate']."</td>
                <td>".$row['returndate']."</td>
                </tr>
                ";
            }
            else {
                echo "<tr id='".$row['id']."' style='background-color:red;'>
                <td placeholder='".$row['id']."'><input type='submit' class='return' value='Return' id='".$row['id']."'></td>
                <td style='color:white;'>@".$row['accessid']."</td>
                <td style='color:white;'>".$row['name']."</td>
                <td style='color:white;'>".$row['bname']."</td>
                <td style='color:white;'>".$row['issuedate']."</td>
                <td style='color:white;'>".$row['returndate']."</td>
                </tr>
                ";
            }
        }
    }
    else
    {
        echo "No record to display";
    }
}
else
{
    echo mysqli_error($conn);
}
}
else if($type == "false")
    {
        $sql = "SELECT * FROM accessrec WHERE active='false'";
        $res = mysqli_query($conn,$sql);
        if(empty(mysqli_error($conn)))
        {
            if(mysqli_num_rows($res)>0)
            {
            while($row = mysqli_fetch_assoc($res))
                {
                    echo "
                    <tr>
                    <td>@".$row['accessid']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['bname']."</td>
                    <td>".$row['issuedate']."</td>
                    <td>".$row['returndate']."</td>
                    <td>".$row['actual']."</td>
                    </tr>
                    ";
                }
            }
            else
            {
                echo "No record to display";
            }
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
else if($type == "addrecord")
    {
        $data = $_POST['data'];
        $sql = "SELECT title FROM books WHERE accessid='".$data[0]."'";
        $res = mysqli_query($conn,$sql);
        $errorcheck=false;
        $row = mysqli_fetch_assoc($res);
        if(!empty($row['title']))
        {
        $title = $row['title'];
        //var_dump($data);
        $sql = "INSERT INTO accessrec (accessid,name,bname,issuedate,returndate,active) VALUES('".$data[0]."','".$data[1]."','".$title."','".$data[2]."','".$data[3]."','true')";
        mysqli_query($conn,$sql);
        }
        else
        {
            $errorcheck = true;
        }
        if($errorcheck)
        {
            echo "error";
        }
        else if(!empty(mysqli_error($conn)))
        {
            echo mysqli_error($conn);
        }
        else
        {
            $sql1 = "SELECT * FROM accessrec ORDER BY id DESC LIMIT 1";
			$row = mysqli_query($GLOBALS['conn'],$sql1);
			$res = mysqli_fetch_assoc($row);
			$id = $res['id'];
            $date1=date('Y-m-d');
          
            if(strtotime($date1) < strtotime($data[3]))
            {
                
            echo "
            <tr id='".$id."' style='background-color:#00ffbf;'>
            <td  placeholder='".$id."'><input type='submit' class='return' value='Return' id='".$id."'></td>
            <td>@".$data[0]."</td>
            <td>".$data[1]."</td>
            <td>".$title."</td>
            <td>".$data[2]."</td>
            <td>".$data[3]."</td>
            </tr>
            ";
            }
            else if(strtotime($date1) == strtotime($data[3]))
            {
                
            echo "
            <tr id='".$id."' style='background-color:yellow;'>
            <td placeholder='".$id."'><input type='submit' class='return' value='Return' id='".$id."'></td>
            <td>@".$data[0]."</td>
            <td>".$data[1]."</td>
            <td>".$title."</td>
            <td>".$data[2]."</td>
            <td>".$data[3]."</td>
            </tr>
            ";

            }
            else {
                
            echo "
            <tr id='".$id."' style='background-color:red;'>
            <td placeholder='".$id."'><input type='submit' class='return' value='Return' id='".$id."'></td>
            <td style='color:white;'>@".$data[0]."</td>
            <td style='color:white;'>".$data[1]."</td>
            <td style='color:white;'>".$title."</td>
            <td style='color:white;'>".$data[2]."</td>
            <td style='color:white;'>".$data[3]."</td>
            </tr>
            ";
                }
        }
    }
else {
    # code...
    $data = $_POST['data'];
    $date = $_POST['date'];
    $sql = "UPDATE accessrec SET active='false',actual='".$date."' WHERE id='".$data."'";
    mysqli_query($conn,$sql);
    if(empty(mysqli_error($conn)))
    {
        echo "Book Return recorded";
    }
}
?>