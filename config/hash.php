<?php
if (isset($_POST['senha'])) {
    echo password_hash($_POST['senha'], PASSWORD_DEFAULT);
}
?>

<form method="post">
    <input type="text" name="senha">
    <input type="submit" value="">
</form>