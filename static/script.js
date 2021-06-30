var app = new Vue({
    el: '#app',
    data: {
        header: 'Защити свои данные',
        sign_up: 'Регистрация',
        log_in: 'Вход',

        form: '',
        encoding: 'Кодировать',

        name: '',
        lastname: '',
        login: '',
        password: '',
        registration: 'Регистрация',
        log: 'Войти',
        exit: 'Выход',
        URL: ''

    },
    methods:{
        regBtn: function () {
            var user= document.getElementById('user').hidden = true
            var regbtn = document.getElementById('reg').hidden = false
            var logbtn = document.getElementById('log').hidden = true

        },
        logBtn: function () {
            var user= document.getElementById('user').hidden = true
            var logbtn = document.getElementById('log').hidden = false
            var regbtn = document.getElementById('reg').hidden = true

        },
        //алгоритм кодирования текста в картику
        draw: function (){
            var canvas = document.getElementById('textCanvas'),
                ctx = canvas.getContext('2d'),
                input = document.getElementById('text'),
                width = +(canvas.width = 400),
                height = +(canvas.height = 300),
                fontFamily = "Arial",
                fontSize = "24px",
                fontColour = "black";

            function fragmentText(text, maxWidth) {
                var words = text.split(' '),
                    lines = [],
                    line = "";
                if (ctx.measureText(text).width < maxWidth) {
                    return [text];
                }
                while (words.length > 0) {
                    while (ctx.measureText(words[0]).width >= maxWidth) {
                        var tmp = words[0];
                        words[0] = tmp.slice(0, -1);
                        if (words.length > 1) {
                            words[1] = tmp.slice(-1) + words[1];
                        } else {
                            words.push(tmp.slice(-1));
                        }
                    }
                    if (ctx.measureText(line + words[0]).width < maxWidth) {
                        line += words.shift() + " ";
                    } else {
                        lines.push(line);
                        line = "";
                    }
                    if (words.length === 0) {
                        lines.push(line);
                    }
                }
                return lines;
            }



            function draw() {
                ctx.save();
                ctx.clearRect(0, 0, width, height);
                ctx.font = "bold " + fontSize + " " + fontFamily;
                ctx.textAlign = "center";
                ctx.fillStyle = fontColour;
                var lines = fragmentText(input.value, width - parseInt(fontSize,0));
                lines.forEach(function(line, i) {
                    ctx.fillText(line, width / 2, (i + 1) * parseInt(fontSize,0));
                });
                ctx.restore();
                console.log(ctx.canvas.toDataURL())
                this.URL = ctx.canvas.toDataURL()
            }

            draw()



        },
        regBtn_menu: function () {

            if (this.name != '' && this.lastname != '' && this.login != '' && this.password != ''){
               console.log(this.name)
            }

        },
        logBtn_menu: function () {
            if (this.login != '' && this.password != ''){
                var logbtn = document.getElementById('log').hidden = true
                var user= document.getElementById('user').hidden = false
                var sign = document.getElementById("sign-log").hidden = true
                var user_name = document.getElementById('name').hidden = false
                console.log(this.name)
            }

        },
    }
})


