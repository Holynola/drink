<style>

/* Sidebar */

.sidebar {
    min-height: 100vh;
    width: 0;
    padding: 6px 0;
    z-index: 99;
    background-color: var(--noir);
    transition: all 0.5s ease;
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
}

.sidebar.open {
    width: 250px;
    padding: 6px 14px;
}

.sidebar .logo_details {
    height: 60px;
    display: flex;
    align-items: center;
    position: relative;
    padding: 0 14px;
}

.sidebar .logo_details .fa-audible {
    opacity: 0;
    transition: all 0.5s ease;
}

.sidebar .logo_details .logo {
    font-size: 24px;
    font-family: 'Rio';
    opacity: 0;
    transition: all 0.5s ease;
    color: var(--blanc);
    margin-left: 10px;
}

.sidebar.open .logo_details .fa-audible,
.sidebar.open .logo_details .logo {
    opacity: 1;
}

.sidebar .logo_details #btn {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    font-size: 25px;
    text-align: center;
    cursor: pointer;
    transition: all 0.5s ease;
    color: var(--blanc);
}

.sidebar.open .logo_details #btn {
    text-align: right;
}

.sidebar i {
    color: var(--blanc);
    height: 60px;
    line-height: 60px;
    min-width: 50px;
    font-size: 24px;
    text-align: center;
}

.sidebar .nav-list {
    margin-top: 20px;
    height: 100%;
}

.sidebar li {
    position: relative;
    margin: 8px 0;
    list-style: none;
}

.sidebar li .tooltip {
    display: none; /* Désactive les tooltips en version mobile */
}

.sidebar li a {
    display: flex;
    height: 100%;
    width: 100%;
    align-items: center;
    text-decoration: none;
    background-color: var(--noir);
    position: relative;
    transition: all 0.5s ease;
    z-index: 12;
}

.sidebar li a::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    transform: scaleX(0);
    background-color: var(--rouge);
    border-radius: 5px;
    transition: transform 0.3s ease-in-out;
    transform-origin: left;
    z-index: -2;
}

.sidebar li a:hover::after {
    transform: scaleX(1);
    color: var(--noir);
}

.sidebar li a .link_name {
    color: var(--blanc);
    font-size: 16px;
    font-weight: 400;
    white-space: nowrap;
    pointer-events: auto;
    transition: all 0.4s ease;
    pointer-events: none;
    opacity: 0;
}

.sidebar.open li a .link_name {
    opacity: 1;
    pointer-events: auto;
}

.sidebar li i {
    height: 35px;
    line-height: 35px;
    font-size: 18px;
    border-radius: 5px;
}

.sidebar li.profile {
    position: absolute;
    height: 60px;
    width: 0;
    left: 0;
    bottom: 0;
    padding: 10px 0;
    overflow: hidden;
    transition: all 0.5s ease;
}

.sidebar.open li.profile {
    width: 250px;
    padding: 10px 14px;
}

.sidebar .profile .profile_details {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}

.sidebar li.profile .name,
.sidebar li.profile .designation {
    font-size: 15px;
    font-weight: 400;
    color: var(--blanc);
    white-space: nowrap;
}

.sidebar li.profile .designation {
    font-size: 12px;
}

.sidebar .profile #log_out {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    background-color: var(--noir);
    width: 100%;
    height: 60px;
    line-height: 60px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.5s ease;
}

.sidebar.open .profile #log_out {
    width: 50px;
    background: none;
}

.home-section {
    position: relative;
    min-height: 100vh;
    top: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    transition: all 0.5s ease;
    z-index: 2;
}

.sidebar.open ~ .home-section {
    left: 250px;
    width: calc(100% - 250px);
}

/* Mobile menu button (always visible) */
.mobile-menu-btn {
    position: fixed;
    top: 10px;
    left: 10px;
    z-index: 100;
    font-size: 25px;
    color: var(--blanc);
    background-color: var(--noir);
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    display: block;
}

/* Responsive */
@media (min-width: 768px) {
    .sidebar {
        width: 78px;
        padding: 6px 14px;
    }
    
    .sidebar li.profile {
        width: 78px;
    }
    
    .home-section {
        left: 78px;
        width: calc(100% - 78px);
    }
    
    .mobile-menu-btn {
        display: none;
    }
    
    .sidebar li .tooltip {
        display: block;
        position: absolute;
        top: -20px;
        left: calc(100% + 15px);
        z-index: 3;
        background-color: var(--blanc);
        box-shadow: 0 5px 10px rgba(0,0,0,0.3);
        padding: 6px 14px;
        font-size: 15px;
        font-weight: 400;
        border-radius: 5px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
    }
    
    .sidebar li:hover .tooltip {
        opacity: 1;
        pointer-events: auto;
        transition: all 0.4s ease;
        top: 50%;
        transform: translateY(-50%);
    }
}

/* Top */

.top {
    text-align: center;
    width: 100%;
    margin: 20px 0 40px;
}

.top h4 {
    font-size: 30px;
}

/* Responsive */

@media (max-width: 600px) {    
    .top {
        padding-top: 50px;
    }
}

@media (max-width: 450px) {
    .top h4 {
        font-size: 20px;
    }
}

@media (max-width: 300px) {
    .home-section {
        padding: 0;
    }
}

@media (max-height: 700px) {
    .sidebar {
        height: auto;
    }

    .sidebar li.profile {
        position: relative;
        margin-left: -14px;
        margin-top: 200px;
    }
}

</style>