class Login {
    constructor(){
        this.start();
    }


    async start(){
        document.querySelector('form.login').onsubmit = async (e) =>{
            e.preventDefault()
            try{
                const {data} = await axios.post('/api/users/login', {
                    email: document.querySelector('[v-model="user.email"]').value,
                    password: document.querySelector('[v-model="user.password"]').value
                })
                window.localStorage.setItem('token', data.data.token);
                window.location = '/home';
            }catch(e){
                Swal.fire({
                    title: 'Error!',
                    text: e.response.data.message,
                    icon: 'error',
                })
            }
        }
        let urlIMG = `url(https://picsum.photos/${window.innerWidth}/${window.innerHeight}/?gravity=south})`;
        document.querySelector('.background-radom-img').style = `background-image: ${urlIMG}`;
        
        while(true){
            await new Promise(r=>setTimeout(r, 3500))
            urlIMG = `url(https://picsum.photos/${window.innerWidth}/${window.innerHeight}/?gravity=south&${new Date().getTime()})`;
            document.querySelector('.pre-load-img').style  = `background-image: ${urlIMG}`;
            await new Promise(r=>setTimeout(r, 3500))
            document.querySelector('.background-radom-img').style = `background-image: ${urlIMG}`;
        }
    }

    
}

const login = new Login();