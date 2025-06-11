function textCounter(field, field2, maxlimit) {
    var countfield = document.getElementById(field2);
    if (field.value.length > maxlimit) {
        field.value = field.value.substring(0, maxlimit);
    }
    countfield.value = Math.max(0, maxlimit - field.value.length);
    }
    document.addEventListener("DOMContentLoaded", function () {
        textCounter(document.getElementById('message'), 'counter', 140);
        document.getElementById('message').addEventListener('keyup', function() {
            textCounter(this, 'counter', 140);
        });
    });