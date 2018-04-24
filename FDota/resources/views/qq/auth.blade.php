<script>
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.hash.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    var access_token = getQueryString('access_token');
    window.location.href="{{ url('auth/qq') }}?access_token=" + access_token;
</script>