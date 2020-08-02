<?php
  /*
  *   Realisé par : KANADI SARA & HANNANI MOHAMED
  */
  $Video_base_url = 'https://www.googleapis.com/youtube/v3';
  $Playlist_base_url = 'https://www.googleapis.com/youtube/v3/playlists';
  /*$api_public_key = 'AIzaSyB549Vc4xr-WMu_EECWbVlebBbg-VABIUk';*/
  $api_public_key = 'AIzaSyBybDGs5-_AwEuwe6LLxfqrkD5EeAREovM';
  /*$api_public_key = 'AIzaSyCnNvHJc0GYF5V_9NP7n3xVn2SFMNvD9cs';*/
  /*$api_public_key = 'AIzaSyA5BTpA0nISGbh387SF6YyP4Nfn8z5rUpE';*/
  /*$api_public_key = 'AIzaSyD3yjyhK_1PlXKHWjRirE-TevgCceJe8kg';*/
  
  /* I used a lot of API KEY to perhaps the limitation of its use 
  SO I SWITCH BETWEEN THEM WHEN NEEDED :)
  */
  error_reporting(0);
  
  $id_Unique=uniqid('quer', false);
?>
<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Youtube Api</title>
    <link href="css/styleProject.css" rel="stylesheet">

  </head>

  <body>
        <!-- Footer -->
        <footer class="footer_element">
      <p class="Copyright">Copyright &copy; Youtube API 2019</p>
      </footer>
    <!-- Navigation -->
    <nav class="navbar">
      <img src="youtube_logo.png" class="imglogo" width="120" height="60" alt="Youtube_logo">
    </nav>

    <!--Container-->
    <div class="container1 split left">  
      <h1 class="autotype">Are you searching for<span>&nbsp</span><span class="txt-type" data-wait="300" data-words='["videos ?","playlists ?"]'></span> 
      </h1>
      <form method="post" action="dashboard.php">
        <input required type="text" name="query" class="form-control" placeholder="Type a query...">
        <select class="custom-select" id="inlineFormCustomSelect" name="typeOFdata">
          <option selected>Video</option>
          <option >Channel</option>
        </select>
      <div class="quantity">
        <input type="number" min="1" max="40" name="NumberOfResult" value="20"  placeholder="Type the number of result">
      </div><br><br>
      <div class="quantity1">
        <button type="submit"  value="click" class="btn btn-primary mb-2" onclick="hideAllrequest()">Search</button>
      </div>
      </form>
    </div>

    <div class="ligne1">
      <button type="submit"  value="click" class="btnQuery q1" onclick="sleepFor(700);Question_1()">Question 1</button>
      <button type="submit"  value="click" class="btnQuery q2" onclick="sleepFor(700);Question_2()">Question 2</button>
      <button type="submit"  value="click" class="btnQuery q3" onclick="sleepFor(700);Question_3()">Question 3</button>
      <button type="submit"  value="click" class="btnQuery q4" onclick="sleepFor(700);Question_4()">Question 4</button>
      <button type="submit"  value="click" class="btnQuery q5" onclick="sleepFor(700);Question_5()">Question 5</button>
    </div>
    <div class="ligne2">
      <button type="submit"  value="click" class="btnQuery q6" onclick="sleepFor(700);Question_6()">Question 6</button>
      <button type="submit"  value="click" class="btnQuery q7" onclick="sleepFor(700);Question_7()">Question 7</button>
      <a href="dashboard.php">
        <button type="submit"  value="click" class="clear" onclick="sleepFor(500);clear_screen();">Clear screen</button>
      </a>
    </div>

    <!-- Page Content -->
    <div class="container2 split right">
      <div class="Question_1_Reponce reponces">
        <table>
        <tr>
          <td>QueryText</td>
          <td>VideoId</td>
          <td>Title</td>
          <td>LikeCount</td>
        </tr>
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) 
          {
            die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT q.QueryText, v.videoId, v.Title,v.likeCount FROM s_query q , video v , etag e  WHERE e.id = q.id AND v.videoId = e.videoId  AND v.likeCount = ( SELECT max(v.likeCount) FROM video v, etag e WHERE  e.id = q.id  AND v.videoId = e.videoId ) Order By likeCount Desc;";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {
              while ($row = $rest-> fetch_assoc()) 
            {
              echo "<tr>";
              echo "<td>".$row['QueryText'] . "</td>";
              echo "<td>".$row['videoId'] . "</td>";
              echo "<td>".$row['Title'] . "</td>";
              echo "<td>".$row['likeCount'] . "</td>";
              echo "<tr>";
            }
          }
        ?>
        </table>
      </div> 

      <div class="Question_2_Reponce reponces">
        <table>
        <tr>
          <td>QueryText</td>
          <td>VideoId</td>
          <td>Title</td>
          <td>dislikeCount</td>  
        </tr>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) 
          {
            die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT q.QueryText, v.videoId, v.Title , v.dislikeCount FROM s_query q , video v , etag e  WHERE e.id = q.id AND v.videoId = e.videoId AND v.dislikeCount = ( SELECT max(v.dislikeCount) FROM video v, etag e WHERE  e.id = q.id  AND v.videoId = e.videoId) GROUP BY dislikeCount DESC";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {

            while ($row = $rest-> fetch_assoc()) 
            {
              echo "<tr>";
              echo "<td>".$row['QueryText'] . "</td>";
              echo "<td>".$row['videoId'] . "</td>";
              echo "<td>".$row['Title'] . "</td>";
              echo "<td>".$row['dislikeCount'] . "</td>";
              echo "<tr>";
            }
          }
          ?>
        </table>          
      </div>

      <div class="Question_3_Reponce  reponces">
        <table class="long">
        <tr>
          <td>QueryText</td>
          <td>videoId</td>
          <td>Title</td>
          <td>Year</td>
        </tr>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) 
          {
            die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT  q.QueryText ,v.videoId ,v.Title,YEAR(v.PublishedAt) FROM video v , etag e ,s_query q WHERE v.videoId = e.videoId AND e.id = q.id GROUP BY  q.QueryText , YEAR(v.PublishedAt ) ORDER BY YEAR(v.PublishedAt) DESC";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {

            while ($row = $rest-> fetch_assoc()) 
            {
            echo "<tr>";
            echo "<td>".$row['QueryText'] . "</td>";
            echo "<td>".$row['videoId'] . "</td>";
            echo "<td>".$row['Title'] . "</td>";
            echo "<td>".$row['YEAR(v.PublishedAt)'] . "</td>";
            echo "<tr>";
            }
          }
          ?>
        </table>
      </div>

      <div class="Question_4_Reponce reponces">
        <table>
        <tr>
          <td>VideoId</td>
          <td>Title</td>
          <td>CountCommentNumber</td>
          <td>CountAuthors</td>
        </tr>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) 
          {
            die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT v.videoId,v.Title, ( Count(cm.ID_comment) + ( SELECT COUNT(cm.parentId) FROM videocomment cm , video v WHERE cm.parentId is not null and v.videoId = cm.videoId_ID_Video)) A, Count(DISTINCT cm.Authorchannelid ) B FROM   video v  , videocomment cm , channel c WHERE  v.videoId = cm.videoId AND cm.Authorchannelid  = cm.Authorchannelid  GROUP BY v.videoId";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {
            while ($row = $rest-> fetch_assoc()) 
            {
              echo "<tr>";
              echo "<td>".$row['videoId'] . "</td>";
              echo "<td>".$row['Title'] . "</td>";
              echo "<td>".$row['A'] . "</td>";
              echo "<td>".$row['B'] . "</td>";
              echo "<tr>";
            }
          }
        ?>
        </table>
      </div>

      <div class="Question_5_Reponce reponces">
        <table>
        <tr>
          <td>QueryText</td>
          <td>VideoId</td>
          <td>Title </td>
          <td>LikeCount </td>
        </tr>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT q.QueryText, v.videoId, v.Title,v.likeCount from s_query q , video v , etag e WHERE e.id = q.id  AND e.videoId = v.videoId AND v.likeCount=( SELECT max(v.likeCount) from video v, etag e WHERE  e.id = q.id  AND v.videoId = e.videoId and q.QueryText = 'bootstrap'  ) ORDER BY v.likeCount DESC";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {
            while ($row = $rest-> fetch_assoc()) 
            {
              echo "<tr>";
              echo "<td>".$row['QueryText'] . "</td>";
              echo "<td>".$row['videoId'] . "</td>";
              echo "<td>".$row['Title'] . "</td>";
              echo "<td>".$row['likeCount'] . "</td>";
              echo "<tr>";
            }
          }
        ?>
        </table>
      </div>

      <div class="Question_6_Reponce reponces">
        <table>
        <tr>
          <td>QueryText </td>
          <td>VideoId </td>
          <td>Title</td>
          <td>commentCount</td>
        </tr>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) 
          {
            die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT q.QueryText, v.videoId, v.Title,v.commentCount FROM s_query q , video v , etag e  WHERE q.id = e.id  AND e.videoId = v.videoId AND v.commentCount=( SELECT max(v.commentCount) FROM video v, etag e WHERE  e.id = q.id  AND v.videoId = e.videoId ) ORDER BY v.commentCount DESC";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {
            while ($row = $rest-> fetch_assoc()) 
            {
            echo "<tr>";
            echo "<td>".$row['QueryText'] . "</td>";
            echo "<td>".$row['videoId'] . "</td>";
            echo "<td>".$row['Title'] . "</td>";
            echo "<td>".$row['commentCount'] . "</td>";
            echo "<tr>";
            }
          }
        ?>
        </table>       
      </div>

      <div class="Question_7_Reponce reponces">
        <table>
        <tr>
          <td>Authorchannelid </td>
          <td>Authordisplayname </td>
        </tr>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          // Create a connection with the data base
          $conn = new mysqli($servername, $username, $password);
          //Open a connection with XAMP server
          if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
          }
          //select the database
          mysqli_select_db($conn, "youtube");
          $sql = "SELECT distinct authorChannelid,Authordisplayname FROM videocomment WHERE likeCount = ( select max(likeCount) from videocomment)";

          $rest = $conn->query($sql);
          if ($rest->num_rows > 0)
          {

          while ($row = $rest-> fetch_assoc()) 
          {
          echo "<tr>";
          echo "<td>".$row['authorChannelid'] . "</td>";
          echo "<td>".$row['Authordisplayname'] . "</td>";
          echo "<tr>";
          }
          }
        ?>
        </table> 
      </div>
      
      <!-- ---------------------------------------------------------  La resultat de recherche dans youtube -------------------------------------->

    <div class="result">
        <?php     
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
          search();
        } 
        function search()
        {
          $query = str_replace(" ", "+", $_POST["query"]);
          /***************************************************************************************** */
                  /******************************************************/


                  function insertQueryToDataBase($data ){
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password);
                    //Open connection with server
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    //select the database
                    mysqli_select_db($conn, "youtube");
                    
                  $sql = 'INSERT INTO s_query (id , QueryText ) values ("'. $GLOBALS['id_Unique'] . '","' . $data . '")';
                  if ($conn->query($sql) === TRUE) {
                    //echo "New query created successfully";
                  } else {
                    //echo "Q<br>uery error: in " . $sql . "" . $conn->error;
                  }  
                  //close the connection with the database
                    $conn->close();
                }
      /*--------------------------------------------------------------------------------------------------------------------------------------- */
      
                  insertQueryToDataBase($_POST["query"]);
/******************************************************************************* */      
/*-------------------------------------------------------------------API SIDE -----------------------------------------------------------*/
          /**
          * Request from youtube api
          * $type - type of element to search
          * $word - word to search as seach query
          */
          function youtubeRequest($type, $word)
          {
            switch($type)
            {
              case 'video':
              $a=$_POST['NumberOfResult'];
              $request = $GLOBALS['Video_base_url'] . '/search?part=snippet&maxResults='.$a.'&q=' . $word . '&type=video&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request);
              return $contents;
              break;
              case 'channel':
              $request = $GLOBALS['Playlist_base_url'] . '/search?part=snippet&type=channels&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request);
              
              return $contents;
              break;
            }
          }

          /**
          * searching for a video using a query word
          */
          function searchForVideo($word)
          {
            return youtubeRequest('video', $word);
            
          }
          function searchForChannel($word)
          {
            return youtubeRequest('channel', $word);

          }
          /*********************************************************************************************************************************** */
          if($_POST['typeOFdata'] = "Video")
          {
            $data = searchForVideo($query);
            $result = json_decode($data);
            function insertYoutubeThumbnails($videoUrl, $thumbnailUrl, $title)
            {
              echo 
              '
              <div class="innerDiv" style="position:relative;float:left;width:28%;height:180px;margin-left:4%;margin-top:0px; ">
              <a href="'. $videoUrl .'" class="titleUrlvideo"> 
              <img class="img-fluid img-thumbnail"  width="184" height="110" src="'. $thumbnailUrl . '" alt="">
              <h5 class="titlevideo">'. $title . '</h5>
              </a>
              </div>
              ';

            }
            echo '<div class="containerVideo" style="width:100%;overflow:hidden;display:inline-block;">';
            for($i=0; $i < count($result->items); $i++)
            {
              
              insertYoutubeThumbnails('https://www.youtube.com/watch?v=' . $result->items[$i]->id->videoId, $result->items[$i]->snippet->thumbnails->high->url, str_replace("K/DA", "", $result->items[$i]->snippet->title));
            }
            echo '</div>';
/*-----------------------------------------------------------------DATA BASE SIDE-------------------------------------------------------- */
/*
* La partie suivante décrit la connection de notre base de donnée avec le SGBD Mysql.
* les tables crées sont à la base des resultats des fichiers Json du IP youtube référence .
*/
/**
* Insert the query to database
*/

/*--------------------------------------------------------------------------------------------------------------------------------------- */



/*---------------------------------------------------------------API SIDE  ----------------------------------------------------------------*/

            /*Getting a channel details using its id from youtube api
            */
            function getChannelDetails($channelId)
            {
              $request = $GLOBALS['Video_base_url'] . '/channels?id=' . $channelId . '&part=snippet&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request); //Send Get Request to youtube api and getting a json response
              return $contents;
            }

            /**
            * Getting a channel statistics using channelId from youtube api
            */
            function getChannelStatistics($channelId)
            {
              $request = $GLOBALS['Video_base_url'] . '/channels?id=' . $channelId . '&part=statistics&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request); //Send Get Request to youtube api and getting a json response
              return $contents;
            }
/*------------------------------------------------------------------------------------------------------------------------------------/

/*----------------------------------------------------------------DATABASE SIDE------------------------------------------------------*/

            /**
            * Insert channel to database
            * $data - json channel data
            */
            function insertChannelToDatabase($data, $statistics){
              $servername = "localhost";
              $username = "root";
              $password = "";
              // Create connection
              $conn = new mysqli($servername, $username, $password);
              $channel = json_decode($data);
            $channelStatistics = json_decode($statistics);
            
              //Open connection with server
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              //select the database
              mysqli_select_db($conn, "youtube");
              //insert videos to the table
              $sql = 'INSERT INTO channel VALUES ("' . $channel->items[0]->id . '", "' . htmlspecialchars($channel->items[0]->snippet->title) . '","' . htmlspecialchars($channel->items[0]->snippet->description) . '", "' . htmlspecialchars ($channel->items[0]->snippet->publishedAt) . '" , ' . $channelStatistics->items[0]->statistics->viewCount . ',' . $channelStatistics->items[0]->statistics->commentCount . ',' . $channelStatistics->items[0]->statistics->subscriberCount . ',' . $channelStatistics->items[0]->statistics->videoCount . ')';
              if ($conn->query($sql) === TRUE) {
                //echo "<br>New channel created successfully";
              } else {
                //echo "<br>channel error: in " . $sql . " " . $conn->error;
              }
              //close the connection with the database
              $conn->close();
          }

            /**
            * Insert video to database
            * $data - json  data
            */
            function insertVideoToDatabase($data,$data1, $query){
              $servername = "localhost";
              $username = "root";
              $password = "";
              // Create connection
              $conn = new mysqli($servername, $username, $password);
              $video = json_decode($data);
            $videoStatistics = json_decode($data1);
              //Open connection with server
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              //select the database
              mysqli_select_db($conn, "youtube");
              //insert videos to the table
              insertChannelToDatabase(getChannelDetails($video->items[0]->snippet->channelId), getChannelStatistics($video->items[0]->snippet->channelId));

              $sql = 'INSERT INTO video(videoId,Description,Title,PublishedAt,commentCount,dislikeCount,likeCount,viewCount,ChannelId ) VALUES ("' . $video->items[0]->id . '","' . htmlspecialchars ($video->items[0]->snippet->description) . '","' . htmlspecialchars ($video->items[0]->snippet->title) . '","' . htmlspecialchars ($video->items[0]->snippet->publishedAt). '","' . $videoStatistics->items[0]->statistics->commentCount . '","' . $videoStatistics->items[0]->statistics->dislikeCount . '","' . $videoStatistics->items[0]->statistics->likeCount . '","' . $videoStatistics->items[0]->statistics->viewCount . '","' . $video->items[0]->snippet->channelId .'")';
              if ($conn->query($sql) === TRUE) {
                //echo "<br>New video created successfully";
              } else {
                //echo "<br>video error: in " . $sql . " " . $conn->error;
              }
              //close the connection with the database
              $conn->close();
          }

            /**
            * Insert video comment to database
            */

            function insertVideoComment($data){
              $servername = "localhost";
                $username = "root";
                $password = "";
                // Create connection
                $conn = new mysqli($servername, $username, $password);
                $comment = json_decode($data);
                //Open connection with server
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                //select the database
                mysqli_select_db($conn, "youtube");
              //$sql = 'INSERT INTO comment(ID_comment,Authordisplayname,Authorchannelurl,Authorchannelid,videoId,textDisplay,textOriginal,likeCount,publishedAt,updatedAt) VALUES ("' . $comment->items[0]->id . '", "' . htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->authorDisplayName) . '","' . htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->authorChannelUrl) . '","' . $comment->items[0]->snippet->topLevelComment->snippet->authorChannelId->value . '","' . $comment->items[0]->snippet->videoId . '","' . htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->textDisplay) . '","' . htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->textOriginal). '",' . $comment->items[0]->snippet->topLevelComment->snippet->likeCount . ',"' . htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->publishedAt) . '","' .  htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->updatedAt) . '")';
              $sql = 'INSERT INTO videocomment(Id_comment,Authordisplayname,Authorchannelurl,Authorchannelid,videoId,textDisplay,textOriginal,parentId,likeCount,publishedAt,updatedAt) VALUES ("' . $comment->items[0]->id . '","'.htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->authorDisplayName).'","'. htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->authorChannelUrl).'","'.$comment->items[0]->snippet->topLevelComment->snippet->authorChannelId->value.'","'.$comment->items[0]->snippet->videoId .'","'. htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->textDisplay).'","'.htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->textOriginal).'","'.htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->parentId).'","'.$comment->items[0]->snippet->topLevelComment->snippet->likeCount.'","'.htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->publishedAt).'","'.htmlspecialchars($comment->items[0]->snippet->topLevelComment->snippet->updatedAt).'")'; 
              if ($conn->query($sql) === TRUE) {
                //echo "<br>New videocomment created successfully";
              } else {
                //echo "<br>videocomment error: in " . $sql . " " . $conn->error;
              }
              //close the connection with the database
                $conn->close();
            }

            /**
            * Insert the etag to database
            */

            function insertEtagToDataBase($query, $data){
              $servername = "localhost";
                $username = "root";
                $password = "";
                // Create connection
                $conn = new mysqli($servername, $username, $password);
                //Open connection with server
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                //select the database
                if ($conn->query($sql) === TRUE) {
                  //echo "<br>New Etag created successfully";
                } else {
                  //echo "<br>Etag error: in " . $sql . " " . $conn->error;
                }
                mysqli_select_db($conn, "youtube");
              $sql = 'INSERT INTO etag values ("'. $GLOBALS['id_Unique'] . '","' . $data . '")';
              
                //close the connection with the database
                $conn->close();
            }

/*---------------------------------------------------------------------------------------------------------------------------------- */


/*----------------------------------------------------------API SIDE-----------------------------------------------------------------*/
            /* Getting a video details using its id from youtube api*/
            function getVideoDetails($videoId)
            { 
              $request = $GLOBALS['Video_base_url'] . '/videos?id=' . $videoId . '&part=snippet&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request); //Send Get Request to youtube api and getting a json response
              return $contents;
            }
            /* Getting a video satatistics using videoId from youtube api*/
            function getVideoStatistics($videoId)
            {
              $request = $GLOBALS['Video_base_url'] . '/videos?id=' . $videoId . '&part=statistics&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request); 
              return $contents;
            }
            /* Getting a video commentThreads using videoId from youtube api*/
            function getVideoCommentThreads($videoId)
            {
              $request = $GLOBALS['Video_base_url'] . '/commentThreads?videoId=' . $videoId . '&part=snippet&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request); 
              return $contents;
            }
            function getVideoComment($commentId)
            {
              $request = $GLOBALS['Video_base_url'] . '/commentThreads?id=' . $commentId . '&part=snippet&key=' . $GLOBALS['api_public_key'];
              $contents = file_get_contents($request); 
              return $contents;
            }

/*---------------------------------------------------------------------------------------------------------------------------------------- */
            for($i=0; $i < count($result->items); $i++)
            {
              insertVideoToDatabase(getVideoDetails($result->items[$i]->id->videoId),getVideoStatistics($result->items[$i]->id->videoId), $query);
              insertEtagToDataBase($GLOBALS['id_Unique'], $result->items[$i]->id->videoId);
              $content = json_decode(getVideoCommentThreads($result->items[$i]->id->videoId));
              for($j=0; $j < count($content->items); $j++) 
              {
                insertVideoComment(getVideoComment($content->items[$j]->id));
              }

            }
          }
          else
          {
            $data = searchForChannel($query);
            $result = json_decode($data);
            echo '<div id="container" style="width:auto;overflow:hidden;display:inline-block;">';
            for($i=0; $i < count($result->items); $i++){

            insertYoutubeThumbnails('https://www.youtube.com/watch?v=' . $result->items[$i]->id->videoId, $result->items[$i]->snippet->thumbnails->high->url, str_replace("K/DA", "", $result->items[$i]->snippet->title));
            }
            echo '</div>';
          }
        } 
        ?>
      </div>
    </div>
       <script src="Js/index.js"></script> 
       <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </body> 
  
</html>


