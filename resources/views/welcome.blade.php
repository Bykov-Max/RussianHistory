<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat App</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        .chat-row{
            margin: 50px;
        }

        ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul li{
            padding: 8px;
            background: #928787;
            margin-bottom: 20px;
        }

        ul li:nth-child(2n-2){
            background: #c3c5c5;
        }

        .chat-input{
            border: 1px solid black;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            padding: 8px 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row chat-row">
            <div class="chat-content">
                <ul>
                    @foreach($messages as $message)
                        <b>{{$message->author}}</b>
                        <p>{{$message->content}}</p>
                    @endforeach
                </ul>
            </div>


            <form action="#" method="post">
                @csrf

                <input type="text" name="author" required class="author"> <br><br>
                <textarea name="content" id="text" class="content" cols="40" rows="5" required></textarea><br><br>

                <button class="submit">Submit</button>
            </form>


{{--            <div class="chat-section">--}}
{{--                <div class="chat-box">--}}
{{--                    <div class="chat-input bg-white" id="chatInput" contenteditable="">--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js"
        integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k"
        crossorigin="anonymous"></script>

    <script>
        $(function (){
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

            let chatInput = $('#chatInput');

            let submit = document.querySelector('.submit');
            let author = document.querySelector('.author');
            let content = document.querySelector('.content');

             submit.addEventListener('click', async function (e){
                e.preventDefault();
                await postDataJS("{{route('send.message')}}", author.value, content.value, "{{csrf_token()}}")
                let message = author.value + "<br>" + content.value;
                socket.emit('sendChatToServer', message);
                content.value = "";
             });


            async function postDataJS(route, author, content, _token){
                let response = await fetch(route, {
                    method: "POST",
                    headers: { "Content-Type": "application/json;charset=utf-8" },
                    body: JSON.stringify({author, content, _token})
                })

                return response.json();
            }

            socket.on('sendChatToClient', function (message){
                $('.chat-content ul').append(`<li> ${message} </li>`)
            })
        })
    </script>
</body>
</html>
