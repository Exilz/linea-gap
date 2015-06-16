    <nav>
        <a id="menu_dropdown">Menu <i class="fa fa-bars"></i></a>
        <ul class="menu_dropdown">
            <li>
                <a  class="{{ (Request::is('*index') || Request::is('/') ? 'active' : '') }}" href="/back-office/public">Accueil</a>
            </li>
            <li>
                <a  class="{{ (Request::is('*recherchehoraire') ? 'active' : '') }}" href="/back-office/public/recherchehoraire">Horaires</a>
            </li>
            <li>
                <a class="drop drop-title {{ ((Request::is('*deplacer') || (Request::is('*find')) || (Request::is('*infostrafic'))) ? 'active' : '') }}" href="#">Se déplacer <i class="fa fa-angle-down"></i>&nbsp;</a>
                <ul class="drop drop-list long-menu">
                    <li>
                        <a class="{{ (Request::is('*recherchetrajet') ? 'active' : '') }}" href="/back-office/public/recherchetrajet">Trajet</a>
                    </li>
                    <li>
                        <a class="{{ (Request::is('*plan') ? 'active' : '') }}" href="/back-office/public/plan">Plan interactif</a>
                    </li>

                    @foreach($liensSeDeplacer as $lien)
                        <li>
                            <a class="{{ (Request::is('*page/$lien->titreLien*') ? 'active' : '') }}" href="/back-office/public/page/{{$lien->slug}}">{{$lien->titreLien}}</a>
                        </li>
                    @endforeach
                    
                </ul>
            </li>
            <li>
                <a  class="drop drop-title {{ ((Request::is('*infos') || (Request::is('*faq'))) ? 'active' : '') }}" href="#">Infos pratiques <i class="fa fa-angle-down"></i>&nbsp;</a>
                <ul  class="drop drop-list">
                    <li>
                        <a href="/back-office/public/faq">FAQ</a>
                    </li>
                    <li>
                        <a class="{{ (Request::is('*actualites') ? 'active' : '') }}" href="/back-office/public/actualites">Actualités</a>
                    </li>
                    <li>
                        <a class="{{ (Request::is('*infostrafic') ? 'active' : '') }}" href="/back-office/public/infostrafic">Infos trafic</a>
                    </li>
                    <li>
                        <a class="{{ (Request::is('*liensutiles') ? 'active' : '') }}" href="/back-office/public/liensutiles">Liens utiles</a>
                    </li>
                    <li>
                        <a class="{{ (Request::is('*lieux') ? 'active' : '') }}" href="/back-office/public/lieux">Lieux</a>
                    </li>
                    
                     @foreach($liensInfosPratiques as $lien)
                        <li>
                            <a class="{{ (Request::is('*page/' . $lien->titreLien . '*') ? 'active' : '') }}" href="/back-office/public/page/{{$lien->slug}}">{{$lien->titreLien}}</a>
                        </li>
                    @endforeach
                    
                </ul>
                
                
            </li>
            <li>
                <a  class="{{ (Request::is('*contact') ? 'active' : '') }}" href="/back-office/public/contact">Contact</a>
            </li>
        </ul>
        <ul class="authent">
        @if(!Auth::check())
        
                <li>
                    <a class="icon {{ (Request::is('*login') ? 'active' : '') }}" href="/back-office/public/login" style="padding-right:5px"><i class="fa fa-sign-in"></i> Connexion &nbsp;</a>
                </li>
                <li>
                    <a class="icon {{ (Request::is('*signup') ? 'active' : '') }}" href="/back-office/public/signup"><i class="fa fa-pencil-square-o"></i> Inscription &nbsp;</a>
                </li>
            @else
                <li>
                    <a class="icon logout" href="/back-office/public/logout"><i class="fa fa-sign-out"></i> Déconnexion &nbsp;</a>
                </li>
                <li>
                    <a class="icon {{ (Request::is('*account') ? 'active' : '') }}" href="/back-office/public/account"><i class="fa fa-user"></i> Mon compte &nbsp;</a>
                </li>
            
            
        
        @endif
        </ul>
    </nav>

