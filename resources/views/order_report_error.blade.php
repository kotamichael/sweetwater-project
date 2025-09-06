<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
</head>
<body>
    <h1>Unable to load order report</h1>
    @if(isset($error))
        <p style="color: red;">{{ $error }}</p>
    @endif
</body>
</html>