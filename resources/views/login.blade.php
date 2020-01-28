<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="/css/app.css" rel="stylesheet" type="text/css" >
    <link href="/css/login.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="container">
<div class="background-radom-img" ref="img-background">
       <div class="pre-load-img" ref="pre-load-img"></div>
       
       <Form ref="form" class="login">
           <h1 class="title-project">TESTE LUMEN</h1>
           <div class="row">
                <div class="col-sm-12 form-group">
                    <label> Usuario </label>
                    <input class="form-control"  required v-model="user.email" type="email" ></i-input>
                </div>
           </div>
           <div class="row">
                <div class="col-sm-12 form-group">
                    <label> Senha </label>
                    <input class="form-control" required v-model="user.password" type="password"></i-input>
                </div>
           </div>
           <div class="row">
                <div class="col-sm-12 form-group">
                   <Button long type="submit" @click="login">Login</Button>
                <div>
           </div>
           <br>
           <p>
                Desenvolvido por 
                <a href="https://linkedin.com.br/in/danieloliveirasouza" target="_blank" >
                    Daniel Souza <Icon type="logo-linkedin" />
                </a>
            </p>
       </Form>
    </div>

    <script type="text/javascript" src="/js/login.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</body>
</html>