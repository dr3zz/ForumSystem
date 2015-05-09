<?php
if (isset($_SESSION['messages'])) : ?>
    <div class="centered">
    <?php foreach ($_SESSION['messages'] as $msg) :
        echo '<div class="' . $msg['type'] . '">';
        echo htmlspecialchars($msg['text']);
        echo '</div>';
    endforeach; ?>
    </div>
<?php endif; ?>

<?php unset($_SESSION['messages']);

