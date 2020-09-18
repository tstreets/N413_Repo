            <div class="container-fluid">
                <div id="headline" class="row mt-3">
                    <div class="col-12 text-center">
                        <h1>Questboard Site</h1>
                    </div> <!-- /col-12 -->
                </div> <!-- /row -->
            <div class="row">
                <div id="subtitle" class="col-12 text-center">
                    <h3></h3>
                </div> <!-- /col-12 -->
            </div> <!-- /row -->
            <div id="content" class="row">
                <div class="col-2"></div><!-- spacer -->
                <div class="col-2 mt-5"> <!-- navigation -->  
                    <a href="<?=site_url()?>/questboard/quests" ><h4>Quest List</h4></a>
                    <a href="<?=site_url()?>/questboard/contact" ><h4>Contact Us</h4></a>   
                </div>
                <div class="col-3 text-center"> <!-- image -->
                    <a href="<?= site_url() . QUEST_IMG . $quest["id"] ?>">          
                        <img src="<?= base_url() . QUEST_IMG . $quest["image"]?>" width="100%"; />
                    </a>
                </div> <!-- /image -->
                <div class="col-5"> <!-- caption -->
                    <!-- <a href="<?=site_url()?>/questboard/detail/<?= $quest["id"]?>">  -->
                    <a href="#"> 
                        <h2 style="margin-top:200px;"><?=$quest["title"]?></h2>
                    </a>
                </div>   
            </div> <!-- /row -->
        </div> <!-- /container-fluid --> 
    </body>
    <script>
        $(document).ready(function(){
                document.title = page_title;
                navbar_update(this_page);
            }); //ready   
    </script>
</html>