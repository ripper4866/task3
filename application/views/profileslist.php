<h5>Пользователи:</h5>
<ul>
    <?php foreach ($profiles as $profile): ?>
        <li>
            <?php echo anchor('main/profile/'.$profile->id, $profile->first_name.' '.$profile->last_name); ?>
        </li>
    <?php endforeach; ?>
</ul>