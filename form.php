<?php
include 'top.php';

$txtNameFirst = '';
$txtNameLast = '';
$txtEmail = '';
$txtPhone = '';
$radProject = '';
$chkOneThousand = '';
$chkOneToThree = '';
$chkThreeToSix = '';
$chkSixToNine = '';
$chkNineOrMore = '';
$lstHeardAbout = '';
$txtComments = '';
$message = '';
$dataIsGood = false;

function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = htmlspecialchars(trim($_POST[$field]));
    }
    return $data;
}

function verifyDataExists($input) {
    if ($input == "") {
        return false;
    } else {
        return true;
    }
}
?>
<main class="flexbox">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dataIsGood = true;
        // Get and sanitize the data from the form
        $txtNameFirst = getData("txtNameFirst");
        $txtNameLast = getData("txtNameLast");
        $txtEmail = filter_var(getData("txtEmail"), FILTER_SANITIZE_EMAIL);
        $txtPhone = getData("txtPhone");
        // Add Verification for Phone Data
        $radProject = getData("radProject");
        $chkOneThousand = getData("chkOneThousand");
        $chkOneToThree = getData("chkOneToThree");
        $chkThreeToSix = getData("chkThreeToSix");
        $chkSixToNine = getData("chkSixToNine");
        $chkNineOrMore = getData("chkNineOrMore");
        $lstHeardAbout = getData("lstHeardAbout");
        $txtComments = getData("txtComments");

        // Verify that the data is good 
        // Verify Name
        if (!verifyDataExists($txtNameFirst) or!verifyDataExists($txtNameLast)) {
            print '<p>Please Enter Your First And Last Name</p>';
            $dataIsGood = false;
        }
        // Verify Email
        if (!verifyDataExists($txtEmail) or !verifyDataExists($txtPhone)) {
            print '<p>Please Enter Your Email And Phone Number</p>';
            $dataIsGood = false;
        }
        if (!filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
            print '<p>Please Enter A Valid Email Address</p>';
            $dataIsGood = false;
        }
        if (!preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/', $txtPhone)) {
            // Regular Expression for a phone number from Stack Overflow
            // https://stackoverflow.com/questions/16699007/regular-expression-to-match-standard-10-digit-phone-number
            // First Answer | User: Ravi Thapliyal
            print '<p>Please Enter A Valid Phone Number</p>';
            $dataIsGood = false;
        }
        // Verify Radio Form
        if (!verifyDataExists($radProject)) {
            print '<p>Please Indicate The Type Of Project</p>';
        }
        // Checkboxes
        if (!verifyDataExists($chkOneThousand) and!verifyDataExists($chkOneToThree) and
                !verifyDataExists($chkThreeToSix) and!verifyDataExists($chkSixToNine) and!verifyDataExists($chkNineOrMore)) {
            print '<p>Please Indicate Your Price Range</p>';
            $dataIsGood = false;
        }
        // List
        if (!verifyDataExists($lstHeardAbout)) {
            print '<p>Please Indicate The Type Of Area You Live In</p>';
            $dataIsGood = false;
        }
        // comment
        if (!preg_match('/\w|.|\s/', $txtComments) and $txtComments != "") {
            print '<p>Comment contains invalid characters please remove them</p>';
            $dataIsGood = false;
        }

        if ($dataIsGood) {
            try {
                $sql = 'INSERT INTO `tblLeads`(`fldFirstName`, `fldLastName`, `fldEmail`, `fldPhoneNumber`, '
                        . ' `fldProjectType`, `fldOneThousand`, '
                        . '`fldOneToThreeThousand`, `fldThreeToSixThousand`, '
                        . '`fldSixToNineThousand`, `fldNineOrMoreThousand`, `fldComments`, `fldHeardAbout`) '
                        . 'VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
                $statement = $pdo->prepare($sql);
                $params = [$txtNameFirst, $txtNameLast, $txtEmail, $txtPhone, $radProject, $chkOneThousand, $chkOneToThree, $chkThreeToSix, $chkSixToNine, $chkNineOrMore, $txtComments, $lstHeardAbout];
                if ($statement->execute($params)) {
                    print '<p>Form Submitted</p>';
                    $dataSubmitted = true;
                    $message = 'Thank you we will be in contact soon!' . PHP_EOL
                            . 'Your info was submitted successfully :)';
                    mail($txtEmail, 'River Valley Stone Works', $message);
                } else {
                    print '<p>Form Was Not Submitted</p>';
                }
            } catch (PDOException $e) {
                print '<p>Couldn\'t Insert The Record Please Contact Someone</p>';
            }
        }
    }
    ?>  
    <form action="#" method="POST" class="
          <?php
          if ($dataSubmitted) {
              print 'dontDisplay';
          } else {
              print 'display';
          } 
          ?>">
        <fieldset class="contact">
            <p class="nameFirst">
                <label for="txtNameFirst">First Name</label>
                <input type="text" name="txtNameFirst" id="txtNameFirst" placeholder="First Name" value="<?php
                print $txtNameFirst;
                ?>" required>
            </p>
            <p class="nameLast">
                <label for="txtNameLast">Last Name</label>
                <input type="text" name="txtNameLast" id="txtNameLast" placeholder="Last Name" value="<?php
                print $txtNameLast;
                ?>" required>
            </p>
            <p class="email">
                <label for="txtEmail">Email Address</label>
                <input type="email" name="txtEmail" id="txtEmail" placeholder="Joe@example.com" value="<?php
                print $txtEmail;
                ?>">    
            </p>
            <p class="phone">
                <label for="txtPhone">Phone Number</label>
                <input type="text" name="txtPhone" id="txtPhone" placeholder="(123)456-7891" value="<?php
                print $txtPhone;
                ?>">
        </fieldset>
        <section class="boxes">
            <fieldset class="project">
                <legend>Type of project</legend>
                <p>                       
                    <input type="radio" name="radProject" id="radProject1" value="Patio" 
                           <?php
                           if ($radProject == "Patio") {
                               print 'checked';
                           }
                           ?>>
                    <label for="radProject1">Stone Patio</label>
                </p>
                <p>                        
                    <input type="radio" name="radProject" id="radProject2" value = "Wall"
                           <?php
                           if ($radProject == "Wall") {
                               print 'checked';
                           }
                           ?>>
                    <label for="radProject2">Stone Wall</label>
                </p>
                <p>                        
                    <input type="radio" name="radProject" id="radProject3" value = "Repair"
                           <?php
                           if ($radProject == "Repair") {
                               print 'checked';
                           }
                           ?>>
                    <label for="radProject3">Masonary Repair</label>
                </p>
                <p>                        
                    <input type="radio" name="radTrash" id="radProject4" value="Other"
                           <?php
                           if ($radProject == "Other") {
                               print 'checked';
                           }
                           ?>>
                    <label for="radProject4">Other</label>
                </p>
            </fieldset>

            <fieldset class="priceRange">
                <legend>Price Range</legend>
                <p>                        
                    <input type="checkbox" name="chkOneThousand" id="chkOneThousand" value="1"
                           <?php
                           if ($chkOneThousand == 1) {
                               print 'checked';
                           }
                           ?>>
                    <label for="chkOneThousand">$1000 or less</label>
                </p>
                <p>                       
                    <input type="checkbox" name="chkOneToThree" id="chkOneToThree" value="1"
                           <?php
                           if ($chkOneToThree == 1) {
                               print 'checked';
                           }
                           ?>>
                    <label for="chkOneToThree">$1000 to $3000</label>
                </p>
                <p>                        
                    <input type="checkbox" name="chkThreeToSix" id="chkThreeToSix" value="1"
                           <?php
                           if ($chkThreeToSix == 1) {
                               print 'checked';
                           }
                           ?>>
                    <label for="chkThreeToSix">$3000 to $6000</label>
                </p>
                <p>                       
                    <input type="checkbox" name="chkSixToNine" id="chkSixToNine" value="1"
                           <?php
                           if ($chkSixToNine == 1) {
                               print 'checked';
                           }
                           ?>>
                    <label for="chkSixToNine">$6000 to $9000</label>
                </p>
                <p>                        
                    <input type="checkbox" name="chkNineOrMore" id="chkNineOrMore" value="1"
                           <?php
                           if ($chkNineOrMore == 1) {
                               print 'checked';
                           }
                           ?>>
                    <label for="chkNineOrMore">More Than $9000</label>
                </p>
            </fieldset>
        </section>
        <fieldset class="heardAbout">
            <p>
                <label for="lstHeardAbout">Where did you hear about us?</label>                   
                <select name="lstHeardAbout" id="lstHeardAbout" size="3">
                    <option value="internet"
                            <?php
                            if ($lstHeardAbout == 'internet') {
                                print 'selected';
                            }
                            ?>>Internet
                    </option>
                    <option value="sign"
                            <?php
                            if ($lstHeardAbout == 'sign') {
                                print 'selected';
                            }
                            ?>>Road Sign
                    </option>
                    <option value="friend"
                            <?php
                            if ($lstHeardAbout == 'friend') {
                                print 'selected';
                            }
                            ?>>From A Friend
                    </option>
                </select>
            </p>
        </fieldset>

        <fieldset class="comments">
            <p>
                <label for="txtComments">Comments</label>
                <textarea name="txtComments" id="txtComments" cols="30" rows="4" placeholder="...">
                    <?php
                    print $txtComments;
                    ?>
                </textarea>
            </p>
        </fieldset>

        <fieldset class="submit">
            <p>
                <input type="submit" value="submit">
            </p>
        </fieldset>
    </form>
    <article class="form">
        <h1>River Valley Stone Works</h1>
        <h2>+1(860)304-8427</h2>
        <h2>rivervalleystoneworks@outlook.com</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.5793633546255!2d-72.4235586847104!3d41.38322277926459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e63c80bd870a97%3A0x7b8f4d6a707b5374!2s176%20Essex%20St%2C%20Deep%20River%2C%20CT%2006417!5e0!3m2!1sen!2sus!4v1606752830959!5m2!1sen!2sus" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <!--Embeded Google Maps-->
    </article>
</main>
<?php
include 'footer.php';
?>
</body>

</html>