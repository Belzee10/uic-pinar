<div>
    link de activacion de la cuenta 
    {{ URL::to('register/verify/' . $user->confirmation_code) }}.<br/>
</div>