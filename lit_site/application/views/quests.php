
        <div class="questboard">
    

        <h1 style="width: 100%; text-align: center; margin: 0 auto 24px;">Quests</h1>

        <?php
            $count = 0;
            foreach($quests as $quest)
            {
                $count++;
                echo '
                <details class="quest" data-open="false" data-col="'. ($count % 3) .'">
                    <summary class="quest__summary">
                        <img 
                            class="quest__image" 
                            src="' . base_url() . QUEST_IMG . $quest["image"] . '" 
                            alt="' . $quest['title'] . '"
                        ></img>
                        <div>
                            <h2 class="quest__title">'. $quest['title'] .'</h2>
                        </div>
                    </summary>
                    
                    <p class="quest__description"><strong>Description: </strong>'. $quest['description'] .'
                    <button class="quest__accept" data-questid="'. $quest['id'] .'">Accept Quest</button>
                    </p>
                    
                </details>
                ';
            }
        ?>

        </div>


        <script src="<?= base_url() ?>assets/js/app.js"></script>
        
        <script>
            $(document).ready(function(){
                    document.title = page_title;
                    navbar_update(this_page);
                }); //ready   
        </script>

    </body>
</html>