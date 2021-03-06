<?php

require_once "modules/main.php";
require_once "pns_get_html.php";
require_once "classes/State.php";
require_once "classes/Episode.php";
require_once "header.php";

$state = new State();
$is_error = false;
$error_msg = "";
$novel = get_novel_obj_once($state->novel_id);
$text = $novel->get_text($state->chap_id, $state->ep_id);
$start_ep_num = $novel->has_chapters ? $novel->chapters[$state->chap_id]->start_ep_num : 0;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title><?php echo h($novel->title); ?></title>
    <?php echo get_style($state); ?>
</head>
<body>
    <?php echo get_header($state); ?>
    <div class="containter">
        <?php if(USE_GET_FUNCTION) : ?>
            <?php echo get_html_reader(); ?>
        <?php else: ?>
            <?php if ($is_error === true) : ?>
                <h1>ERROR</h1>
                <p><?php echo h($error_msg); ?></p>
            <?php else : ?>
                <h1>
                    <?php echo h($novel->title); ?>
                </h1>
                <?php if($novel->has_chapters) : ?>
                    <h2><?php echo h($novel->chapters[$state->chap_id]->title); ?></h2>
                    <h3><?php echo h($novel->chapters[$state->chap_id]->episodes[$state->ep_id - $start_ep_num]->title); ?></h3>
                <?php else : ?>
                    <h2><?php echo h($novel->episodes[$state->ep_id]->title); ?></h2>
                <?php endif; ?>
                <div class="text">
                    <?php foreach ($text as $line) : ?>
                        <p class="text line"><?php echo $line; ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="text links">
                    <div>
                        <?php if ($state->ep_id - 1 >= 0) : ?>
                            <a href="reader.php?novel=<?php echo h($state->novel_id); ?>&chap=<?php echo h($state->chap_id); ?>&ep=<?php echo h($state->ep_id - 1); ?>">
                                ??????
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="ep_list.php?novel=<?php echo h($state->novel_id); ?>">
                            ???????????????
                        </a>
                    </div>
                    <div>
                        <?php if ($state->ep_id + 1 > $novel->get_max_ep()) : ?>
                            <a href="reader.php?novel=<?php echo h($state->novel_id); ?>&chap=<?php echo h($state->chap_id); ?>&ep=<?php echo h($state->ep_id + 1); ?>">
                                ??????
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="back">
                    <a href="<?php echo h(INDEX_FILE); ?>">
                        ?????????????????????
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script type="text/javascript" src="js/burger.js"></script>
</body>
</html>