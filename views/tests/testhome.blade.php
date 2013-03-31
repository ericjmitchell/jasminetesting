@layout('jasminetesting::tests.testhometemplate')

@section('runners')
<?php
    echo '<ul>
    ';
    foreach ($runners as $value)
    {
        echo '<li>
        ';
        echo '<a href="'.URL::to_route('testRoute').'/'.$value.'">';
        echo $value;
        echo '</a>
    ';
        echo '</li>
';
    }
    echo '</ul>';
?>
@endsection
