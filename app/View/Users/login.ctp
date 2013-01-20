<h2>Login</h2>
<?php
echo $this->Form->create();
echo $this->Form->input('username');
echo $this->Form->input('password');
$options = array(
    'label' => 'Login',
    'class' => 'btn',
);
echo $this->Form->end($options);
?>