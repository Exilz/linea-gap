    <nav>
        <ul>
            <li>
                <a  class="{{ (Request::is('*admin/index') || Request::is('*admin') ? 'active' : '') }}" href="/back-office/public/admin">Accueil</a>
            </li>
            
            <li>
                <a  class="{{ (Request::is('*admin/account') ? 'active' : '') }}" href="/back-office/public/admin/account">mon compte</a>
            </li>
            
           <li>
                <a href="/back-office/public">Retour site</a>
            </li>            

           <li>
                <a href="logout">déconnexion</a>
            </li>
            
        </ul>
    </nav>

