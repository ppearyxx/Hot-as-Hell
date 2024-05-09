class Navbar extends HTMLElement {
    constructor() {
      super();
    }
  
    connectedCallback() {
      this.innerHTML = `
        <header>
            <nav>
                <ul>
                    <li>Home</li>
                    <li>About Us</li>
                    <li>Blog</li>
                    <li>Contact Us</li>
                </ul>

                <img src="./images/logo.png" class="logo">

                <!-- <button class="login-btn">Login</button> -->
            </nav>
        </header>
             
      `;
  
    }
  }
  
  customElements.define('navbar-component', Navbar);
  