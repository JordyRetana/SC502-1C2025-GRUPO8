const translations = {
    es: {
        home: "Inicio",
        sesion: "Inicio de Sesión",
        more: "Más",
        Planes: "Planes",
        search: "Buscar",
        language: "Idioma",
        subtitle: "Impulsa tu Negocio con Nuestra Plataforma Innovadora",
        description: "Descubre cómo nuestra tecnología puede transformar tus operaciones y mejorar tu eficiencia.",
        benefits: "Beneficios Principales",
        efficiency: "Incremento de Eficiencia",
        "efficiency-description": "Optimiza tus procesos y aumenta la productividad.",
        technology: "Tecnología Avanzada",
        "technology-description": "Utiliza las últimas herramientas para destacar en el mercado.",
        support: "Soporte Continuo",
        "support-description": "Asistencia técnica y soporte cuando lo necesites.",
        pricing: "Planes de Precios",
        compare: "Comparar Planes",
        subscribe: "Suscribirse",
        features: "Características",
        emailsupport: "Soporte por Correo Electrónico",
        personalsupport: "Soporte Personalizado",
        cloudstorage: "Almacenamiento en la Nube",
        prioritysupport: "Soporte Prioritario",
        helpcenter: "Acceso a Centro de Ayuda",
        demo: "Demo",
        basic: "Basic",
        pro: "Pro",
        price: "$14.0 /mes",
        basicdescription: "El plan Basic te permite gestionar hasta 20 usuarios.",
        prodescription: "El plan Pro te permite gestionar hasta 120 usuarios por $56 mensuales.",
        description2:"Di adiós al caos de los registros manuales y abraza una forma más inteligente y efectiva de administrar",
        welcomeback: "Bienvenido de nuevo",
        email: "Correo Electrónico",
        password: "Contraseña",
        rememberpassword: "Recordar Contraseña",
        forgotpassword: "¿Olvidaste tu contraseña?",
        loginbutton: "Iniciar Sesión",
        backbutton: "Volver",
        sesion: 'Inicio de Sesión',
            welcomeback: 'Bienvenido de nuevo',
            email: 'Correo Electrónico',
            emailplaceholder: 'Correo Electrónico',
            password: 'Contraseña',
            passwordplaceholder: 'Contraseña',
            rememberpassword: 'Recordar Contraseña',
            forgotpassword: '¿Olvidaste tu contraseña?',
            loginbutton: 'Iniciar Sesión',
            backbutton: 'Volver',
            noaccount: '¿No tienes una cuenta?',
            createaccount: 'Crear cuenta',
        noaccount: "¿No tienes una cuenta?",
        "email-placeholder": "Correo Electrónico",
        firstname: 'Nombre',
        firstnameplaceholder: 'Nombre',
        lastname: 'Apellido',
        lastnameplaceholder: 'Apellido',
        email: 'Correo Electrónico',
        emailplaceholder: 'Correo Electrónico',
        password: 'Contraseña',
        passwordplaceholder: 'Contraseña',
        confirmpassword: 'Confirmar Contraseña',
        confirmpasswordplaceholder: 'Confirmar Contraseña',
        phone: 'Teléfono',
        phoneplaceholder: 'Teléfono',
        address: 'Dirección',
        addressplaceholder: 'Dirección',
        createaccountbutton: 'Crear Cuenta',
        backbutton: 'Volver',
        "password-placeholder": "Contraseña",
        createaccount: "Crear cuenta"
    },
    en: {
        home: "Home",
        sesion: "Login",
        more: "More",
        Planes: "Plans",
        search: "Search",
        language: "Language",
        subtitle: "Boost Your Business with Our Innovative Platform",
        description: "Manage your lessons and students effortlessly with our intuitive and powerful platform.",
        description2: "Say goodbye to the chaos of manual records and embrace a smarter, more efficient way to manage.",
        demodescription: "Management of up to 15 users for 1 month for free.",
        benefits: "Main Benefits",
        efficiency: "Efficiency Increase",
        "efficiency-description": "Optimize your processes and increase productivity.",
        technology: "Advanced Technology",
        "technology-description": "Use the latest tools to stand out in the market.",
        support: "Continuous Support",
        "supportdescription": "Technical assistance and support when you need it.",
        pricing: "Pricing Plans",
        compare: "Compare Plans",
        subscribe: "Subscribe",
        demo: "Demo",
        price: "$14.0 /month",
        basic: "Basic",
        basicdescription: "The Basic plan allows you to manage up to 20 users.",
        pro: "Pro",
        prodescription: "The Pro plan allows you to manage up to 120 users.",
        welcomeback: "Welcome back",
        email: "Email",
        password: "Password",
        sesion: 'Login',
            welcomeback: 'Welcome back',
            email: 'Email',
            emailplaceholder: 'Email',
            password: 'Password',
            passwordplaceholder: 'Password',
            rememberpassword: 'Remember Password',
            forgotpassword: 'Forgot your password?',
            loginbutton: 'Login',
            backbutton: 'Back',
            noaccount: 'Don\'t have an account?',
            createaccount: 'Create account',
        rememberpassword: "Remember Password",
        forgotpassword: "Forgot your password?",
        firstname: 'First Name',
        firstnameplaceholder: 'First Name',
        lastname: 'Last Name',
        lastnameplaceholder: 'Last Name',
        email: 'Email',
        emailplaceholder: 'Email',
        password: 'Password',
        passwordplaceholder: 'Password',
        confirmpassword: 'Confirm Password',
        confirmpasswordplaceholder: 'Confirm Password',
        phone: 'Phone',
        phoneplaceholder: 'Phone',
        address: 'Address',
        addressplaceholder: 'Address',
        createaccountbutton: 'Create Account',
        backbutton: 'Back',
        loginbutton: "Login",
        backbutton: "Back",
        noaccount: "Don't have an account?",
        "email-placeholder": "Email",
        "password-placeholder": "Password",
        createaccount: "Create account"
    }
};

function changeLanguage(lang) {
    localStorage.setItem("lang", lang);

    document.querySelectorAll("[data-lang]").forEach(element => {
        const key = element.getAttribute("data-lang");
        if (translations[lang] && translations[lang][key]) {
            element.textContent = translations[lang][key];
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const storedLang = localStorage.getItem("lang") || "es";
    changeLanguage(storedLang);

    document.querySelectorAll(".dropdown-item[data-lang]").forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const lang = link.getAttribute("data-lang");
            changeLanguage(lang);
        });
    });
});
