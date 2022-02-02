<html>

<head>
</head>

<body>
    <form id="myForm" name="myForm">
        <input type="checkbox" id="chkName" name="chkName" />
        <input type="text" id="name" name="name" /><br />
        <input type="checkbox" id="chkEmail" name="chkEmail" />
        <input type="text" id="email" name="email" /><br />
        <button type="button" id="btn" name="btn">Submit</button>
    </form>
    <script>
        $(document).ready(function() {
            $.validator.addMethod('myName', function(value, element) {
                return value == 'My Name';
            }, 'My Name is incorrect');

            $('#myForm').validate({
                rules: {
                    name: {
                        required: '#chkName:checked',
                        number: '#chkName:checked'
                    },
                    email: {
                        myName: {
                            depends: function(element) {
                                return !!$("#chkEmail:checked").length;
                            }
                        }
                    }
                }
            });

            $('#btn').click(function() {
                $('#myForm').valid();
            });
        });
    </script>
</body>

</html>