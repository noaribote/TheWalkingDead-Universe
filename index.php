<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Walking Dead Universe</title>
    <link rel="icon" type="image/ico" sizes="16x16" href="img/twdicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/section.css">
    <link rel="stylesheet" href="css/controls.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Suez+One&amp;display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Welcome to the TheWalkingDead Universe !">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://github.com/noaribote/TheWalkingDead-Universe">
    <meta property="og:image" content="https://www.amc.com/">
    <meta name="theme-color" content="#000000">
    <meta name="twitter:card" content="summary_image">
    <meta name="author" content="ALOUS FRANCE">
</head>
<body>
    <?php require_once 'php/data.php' ?>

    <nav>
        <button onclick="OpenNAVABR()" class="btn-Navbar"><i class="fa-solid fa-circle-user"></i></button>
        <div class="pts-right-center FlexCenter">
            <?php foreach ($shows as $index => $show): ?>
                <button type="button" aria-label="Go to <?= htmlspecialchars($show['title'], ENT_QUOTES, 'UTF-8') ?>">
                    <i id="ScrollFor<?= $index + 1 ?>" class="section-indicator <?= $index === 0 ? 'fa-solid' : 'fa-regular' ?> fa-circle"<?= $index === 0 ? ' style="color: white;"' : '' ?>></i>
                </button>
            <?php endforeach; ?>
        </div>
        
        <div id="myModal" class="modal">
            <div class="modal-content">
            <div class="div-no-bg">
                <span class="close">&times;</span>
                <div class="FlexCenter">
                    <img class="img-logo-navbar" src="img/series-logo/TWD.webp">
                </div>
                <div class="FlexCenter" style="width: 100%; position: absolute; bottom: 40px;">
                    <input type="text" name="" id="id-element-input">
                    <h3 id="Element-FOR-focus">Username</h3>

                    <input type="email" name="" id="id-element-input2">
                    <h3 id="Element-FOR-focus2">Email</h3>

                    <input type="password" name="" id="id-element-input3">
                    <h3 id="Element-FOR-focus3">Password</h3>

                    <div class="FlexCenter" style="width: 100%; position: relative; top: 20px;">
                        <button class="btn-connect">Login</button>
                        <button class="btn-connect-Singin">Sing-in</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </nav>

    <?php foreach ($shows as $index => $show): ?>
        <?php
        [$trailerVideoId, $introVideoId, $alternateVideoId] = $show['videoIds'];
        $controlNumber = $show['controlNumber'] ?? (string) $index;
        $videoClasses = 'footer-video' . (!empty($show['lazy']) ? ' lazy-video' : '');
        ?>
        <section class="OTHERSsections <?= htmlspecialchars($show['sectionClass'], ENT_QUOTES, 'UTF-8') ?><?= $index === 0 ? ' is-active' : '' ?>" data-section="<?= htmlspecialchars($show['key'], ENT_QUOTES, 'UTF-8') ?>">
            <header>
                <div class="PARAM-TWDetc <?= htmlspecialchars($show['themeClass'], ENT_QUOTES, 'UTF-8') ?>">
                    <img class="navbar-img-logo" src="img/series-logo/<?= htmlspecialchars($show['logo'], ENT_QUOTES, 'UTF-8') ?>.webp"<?= !empty($show['logoStyle']) ? ' style="' . htmlspecialchars($show['logoStyle'], ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
                </div>
            </header>
            <section>
                <div class="description-div">
                    <h1 class="description-title"><?= htmlspecialchars($show['title'], ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="description"><?= htmlspecialchars($show['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </section>
            <footer>
                <div class="footer-amc">
                    <a href="https://www.amc.com/" target="_blank" rel="noopener noreferrer">
                        <img src="img/amc.webp" alt="AMC">
                    </a>
                </div>
                <div class="footer-video-div">
                    <video id="PingVideo<?= htmlspecialchars($trailerVideoId, ENT_QUOTES, 'UTF-8') ?>" class="<?= $videoClasses ?> th0" preload="none" muted loop>
                        <source data-src="video/compressed/<?= htmlspecialchars($show['trailer'], ENT_QUOTES, 'UTF-8') ?>.webm" type="video/webm">
                    </video>
                    <video id="PingVideo<?= htmlspecialchars($introVideoId, ENT_QUOTES, 'UTF-8') ?>" class="footer-video th1" preload="none" muted loop>
                        <source data-src="video/compressed/Intros/<?= htmlspecialchars($show['intro'], ENT_QUOTES, 'UTF-8') ?>.webm" type="video/webm">
                    </video>
                    <video id="PingVideo<?= htmlspecialchars($alternateVideoId, ENT_QUOTES, 'UTF-8') ?>" class="footer-video th2" preload="none" muted loop>
                        <source data-src="video/compressed/<?= htmlspecialchars($show['trailer'], ENT_QUOTES, 'UTF-8') ?>.webm" type="video/webm">
                    </video>
                    <div class="controls" data-video-ids="<?= htmlspecialchars(json_encode(array_map(static fn ($id) => 'PingVideo' . $id, $show['videoIds'])), ENT_QUOTES, 'UTF-8') ?>">
                        <button id="mute<?= htmlspecialchars($controlNumber, ENT_QUOTES, 'UTF-8') ?>" class="btn" type="button" aria-label="Mute or unmute">
                            <i class="fa-solid fa-volume-xmark"></i>
                        </button>
                        <input type="range" id="volume-control<?= htmlspecialchars($controlNumber, ENT_QUOTES, 'UTF-8') ?>" class="volume-control" min="0" max="1" step="0.1" value="1" aria-label="Volume">
                    </div>
                </div>
            </footer>
        </section>
    <?php endforeach; ?>
    <iframe src="https://alous.fr/src/widgets/002.html" style="border:none; overflow:hidden;" loading="lazy" allowfullscreen></iframe>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
<script src="js/controls.js"></script>
<script async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8769745729105064" crossorigin="anonymous" data-checked-head="true"></script>
</html>
