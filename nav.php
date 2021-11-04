    <nav>
        <a  class="<?php
        if ($pathParts['filename'] == "index") {
            print 'activepage';
        }
        ?>" href="index.php">Home Page</a> 

        <a class="form <?php
        if ($pathParts['filename'] == "form") {
            print 'activepage';
        }
        ?>" href="form.php">Contact Us</a>

        <a class="mobile <?php
        if ($pathParts['filename'] == "form") {
           print 'activepage';
       }
       ?>" href="form.php" >Mobile Form (CSS)</a>
    
        <a class="<?php
        if ($pathParts['filename'] == "quote") {
            print 'activepage';
        }
        ?>" href="quote.php">Past Projects</a>

        <a class="form <?php
        if ($pathParts['filename'] == "about") {
            print 'activepage';
        }
        ?>" href="about.php">More Information</a> 

        <a class="mobile <?php
        if ($pathParts['filename'] == "about") {
            print 'activepage';
        }
        ?>" href="about.php">More Information Mobile (CSS)</a> 
    </nav>
</section>

