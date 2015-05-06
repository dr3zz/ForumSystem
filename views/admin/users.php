<h1>USER EDIT</h1>
<?php foreach($this->users as $user) : ?>
    <div><a href="/admin/editUser/<?php echo htmlentities($user['id'])?>"><?php echo htmlentities($user['username']) ?></a></div>
<?php endforeach;  ?>



