<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors template</title>
    <link rel="stylesheet" href="../css/home.css?<?php echo time()?>">
    <link rel="stylesheet" href="../css/mobile.css?<?php echo time()?>">
    
</head>
<body>
    <div class="weird">
        <header>
            <?php
                    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php'
            ?>
        </header>
        <main>
            <h1>Search</h1>
            <form action="/phpmotors/search" method="GET"> 
                <input type="hidden" name="action" value="search">
                <label for="searchInput">What are you looking for today?
                    <input type="text" id="searchInput" name="query" placeholder="Look for something here" required>
                </label>
                <button type="submit">Search</button>
            </form>

            <?php
                if(isset($message)){
                    echo $message;
                }

                if(isset($displayInfo)){
                    echo $displayInfo;
                }
                

            ?>
   
             <div class="pagination">

                <?php
                      if(isset($currentPage)){
                        $prevPage = $currentPage - 1;
                        $nextPage = $currentPage + 1;
  
                          if($currentPage > 1 ){
                             
                          echo"<a href='index.php?action=search&query=$searchQuery&page=$prevPage'>Previous</a>";
                          }

                      }
                    
                    
                    if(isset($numOfPages, $currentPage)){
                     
                        for($i = 1; $i <= $numOfPages; $i++){

                            if($i == $currentPage){
                                echo "<a class='current' href='index.php?action=search&query=$searchQuery&page=$i'>$i</a>";

                            }
                            else{
                                echo "<a href='index.php?action=search&query=$searchQuery&page=$i'>$i</a>";

                            }
                           
                        
                        }
                       
                    }

                    if(isset($currentPage)){
                        if($currentPage< $numOfPages){
                            echo "<a href='index.php?action=search&query=$searchQuery&page=$nextPage'>Next</a>";
                        }
    

                    }

                 
                   
                    

                ?>
               
            </div>

        </main>
        <footer>
            
                <?php

                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';

                ?>
        </footer>
    </div>
    <script src="./scripts/script.js"></script>
    
</body>
</html>