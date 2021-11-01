<?php

    require_once 'helper/connection.php';
    require_once 'repository/content.php';
    require_once 'service/content.php';
    require_once 'configs.php';

    $connection = new Connection(
        $CONFIGS['DB_HOST'], 
        $CONFIGS['DB_USERNAME'],
        $CONFIGS['DB_PASSWORD'],
        $CONFIGS['DB_NAME']
    );
    $connectionCheck = $connection->connectionCheck();
    if(!$connectionCheck['status']){
        echo "Connection to MySQL failed. Error : ".$connectionCheck['message'];
        exit;
    }
    $contentRepo = new ContentRepository($connection);
    $contentService = new ContentService($contentRepo);

    if(isset($_POST['save'])){
        $loginCheck = $contentService->saveContent($_POST);
    }
    $savedStory = $contentService->getContent();
    $story = "";
    if(count($savedStory) > 0) {
        $story = $savedStory[0]['content'];
    }

?>


<html>
    <head>
    </head>
    <body>
        <h1>Admin Story</h1>
        <div>
            <textarea id="story" name="story" rows="8" cols="50" form="form"><?php echo $story; ?></textarea>
        </div>
        <form method="post" action="" id="form">
            <div>
                <input type="submit" value="Submit" name="save" id="save" />
            </div>
        </form>
    </body>
</html>