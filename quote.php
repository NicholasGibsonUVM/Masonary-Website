<?php
include 'top.php';
?>
<main class="grid-layout">
    <h1 class="project">Our Past Projects</h1>
    <article class="wall">      
        <h2>Stone Walls</h2>
        <?php
        $sql = 'SELECT `txtProjectType`, `txtProjectDescription`, `txtProjectPicture` FROM `tblPastProjects` WHERE `txtProjectType` = "Stone Wall"';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll();
        foreach ($records as $record) {
            print '<figure><img src="' . $record['txtProjectPicture'] . '" alt="Error"></figure>';
            print '<p>' . $record['txtProjectDescription'] . '</p>';
        }
        ?>
    </article>
    <article class="patio">
        <h2>Patios</h2>
        <?php
        $sql = 'SELECT `txtProjectType`, `txtProjectDescription`, `txtProjectPicture` FROM `tblPastProjects` WHERE `txtProjectType` = "Patio"';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll();
        foreach ($records as $record) {
            print '<figure><img src="' . $record['txtProjectPicture'] . '" alt="Error"></figure>';
            print '<p>' . $record['txtProjectDescription'] . '</p>';
        }
        ?>
    </article>
    <article class="repair">
        <h2>Masonry Repair</h2>
        <?php
        $sql = 'SELECT `txtProjectType`, `txtProjectDescription`, `txtProjectPicture` FROM `tblPastProjects` WHERE `txtProjectType` = "Repair"';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll();
        foreach ($records as $record) {
            print '<figure><img src="' . $record['txtProjectPicture'] . '" alt="Error"></figure>';
            print '<p>' . $record['txtProjectDescription'] . '</p>';
        }
        ?>
    </article>
</main>
<?php
include 'footer.php';
?>
</body>
</html>
