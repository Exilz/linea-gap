<?php

                /****************************************************
                 *                                                  *
                 *              ROUTES DU FRONT-OFFICE              *
                 *                                                  *
                 * **************************************************/

// Pages header
Route::get('/', array('as' => 'indexFront', 'uses' => 'FrontController@index'));
Route::get('/deplacer', array('as' => 'deplacer', 'uses' => 'FrontController@deplacer'));

// Pages footer
Route::get('/mentions', array('as' => 'mentions', 'uses' => 'FrontController@mentions'));
Route::get('/plan', array('as' => 'plan', 'uses' => 'FrontController@plan'));
Route::get('/credits', array('as' => 'credits', 'uses' => 'FrontController@credits'));

// (Dé)Connexion utilisateur
Route::get('/login', array('as' => 'loginUser', 'uses' => 'UserLoginController@login'));
Route::post('/login', array('as' => 'authenticateUser', 'uses' => 'UserLoginController@authenticate'));
Route::get('/logout', array('as' => 'logoutUser', 'uses' => 'UserLoginController@logout'));

// Mot de passe oublié
Route::get('/admin/motdepasse', array('as' => 'MotPasse', 'uses' => 'MotPasseController@page'));
Route::post('/admin/motdepasse', array('as' => 'EmailMotPasse', 'uses' => 'MotPasseController@motdepasse'));
Route::get('/admin/motdepasseinit/{token}', array('as' => 'PageMotPasse', 'uses' => 'MotPasseController@initmotdepasse'));
Route::post('/admin/motdepasseinit/{token}', array('as' => 'InitMotPasse', 'uses' => 'MotPasseController@updatemotdepasse'));

// Inscription utilisateur
Route::get('/signup', array('as' => 'signupUser', 'uses' => 'UserLoginController@signup'));
Route::post('/signup', array('as' => 'storeUser', 'uses' => 'UserLoginController@storeUser'));

// Mon compte
Route::get('/account', array('as' => 'accountUser', 'uses' => 'FrontController@account'));
Route::post('/account', array('as' => 'updateUser', 'uses' => 'UserLoginController@updateUser'));

// Contact
Route::get('/contact', array('as' => 'contact', 'uses' => 'FrontController@contact'));
Route::post('/contact', array('as' => 'contactSend', 'uses' => 'EmailController@contactSend'));

// Actualites
Route::get('/actualites', array('as' => 'actualites', 'uses' => 'FrontController@actualites'));
Route::get('/actu/{slug}', array('as' => 'showActu', 'uses' => 'ActualiteController@showActu'));

// Infos pratiques
Route::get('/infos', array('as' => 'infos', 'uses' => 'FrontController@infos'));

// Infos trafic
Route::get('/infostrafic', array('as' => 'infostrafic', 'uses' => 'InfoController@infostrafic'));
Route::get('/infostrafic/json', array('as' => 'infostrafic', 'uses' => 'InfoController@renderJson'));
Route::get('/infostrafic/{slug}', array('as' => 'showInfo', 'uses' => 'InfoController@showInfo'));

// FAQ
Route::get('/faq', array('as' => 'faq', 'uses' => 'FaqController@faq'));
Route::post('/faq', array('as' => 'faqSend', 'uses' => 'FaqController@faqSend'));

// Lien utiles
Route::get('/liensutiles', array('as' => 'liensutiles', 'uses' => 'LienController@liensutiles'));

// Lieux
Route::get('/lieux', array('as' => 'lieux', 'uses' => 'LieuController@lieux'));

// Recherche d'horaires
Route::post('/find', array('as' => 'horairesDispatch', 'uses' => 'HorairesController@dispatchRequest'));
Route::get('/find', array('as' => 'horairesDispatch', 'uses' => 'HorairesController@dispatchRequest'));
Route::get('/findL/{ligne}', array('as' => 'horaireFindOnlyLigne', 'uses' => 'HorairesController@findByLigne'));
Route::get('/findLA/{ligne}/{arret}/{date}/{heureMin}', array('as' => 'horaireFindLigne', 'uses' => 'HorairesController@findByLigneArret'));
Route::post('/findLA', array('as' => 'horairesFindLigneArret', 'uses' => 'HorairesController@findByLigneArret'));
Route::get('/generate/{ligne}', array('as' => 'horaireGeneratePDF', 'uses' => 'HorairesController@horaireGeneratePDF'));

// Routes des pages statiques crées en back-office
Route::get('/page/{slug}', array('as' => 'getPage', 'uses' => 'FrontController@getPage'));

// Page recherche horaire
Route::get('/recherchehoraire', array('as' => 'recherchehoraire', 'uses' => 'FrontController@recherchehoraire'));
Route::get('/recherchetrajet', array('as' => 'recherchetrajet', 'uses' => 'FrontController@recherchetrajet'));

// Plan interactif
Route::get('/plan', array('as' => 'plan', 'uses' => 'PlanController@plan'));
Route::get('/plan/arrets', array('as' => 'getArrets', 'uses' => 'PlanController@getArrets'));
Route::get('/plan/lignes', array('as' => 'getLignes', 'uses' => 'PlanController@getLignes'));
Route::get('/plan/bus', array('as' => 'getBus', 'uses' => 'PlanController@getBus'));
Route::get('/plan/busInfos', array('as' => 'getInfos', 'uses' => 'PlanController@getInfos'));

// Accesibilite
Route::get('/accessibilite', array('as' => 'accessibilite', 'uses' => 'FrontController@accessibilite'));

// Récupération des positions des arrêts pour la création des polylines
Route::get('/admin/lignes/getCoords', array('as' => 'getCoords', 'uses' => 'AdminLignesController@getArretsCoords'));

// Erreur 404
Route::get('/404', array('as' => 'error404', 'uses' => 'FrontController@errorPage'));

                /****************************************************
                 *                                                  *
                 *              ROUTES APPLICATION MOBILE           *
                 *                                                  *
                 * **************************************************/
                 
Route::get('/m/getArrets', array('as' => 'getArrets', 'uses' => 'MobileController@getArrets'));
Route::get('/m/getLignes', array('as' => 'getLignes', 'uses' => 'MobileController@getLignes'));
Route::get('/m/getIdLigne', array('as' => 'getIdLigne', 'uses' => 'MobileController@getIdLigne'));

Route::get('/m/getLignesArret', array('as' => 'getLignesArret', 'uses' => 'MobileController@getLignesArret'));
Route::get('/m/getHoraires/{idLigne}/{date}/{heureMin}', array('as' => 'getHoraires', 'uses' => 'MobileController@getHoraires'));

Route::post('/m/connect', array('as' => 'connect', 'uses' => 'MobileController@connect'));

                /****************************************************
                 *                                                  *
                 *              ROUTES DU BACK-OFFICE               *
                 *                                                  *
                 * **************************************************/


// Connexion de l'administrateur
Route::get('/admin/login', array('as' => 'loginAdmin', 'uses' => 'AdminLoginController@login'));
Route::post('/admin/login', array('as' => 'authenticateAdmin', 'uses' => 'AdminLoginController@authenticate'));
Route::get('/admin/logout', array('as' => 'logoutAdmin', 'uses' => 'AdminLoginController@logout'));

// Routes nécessitant une connexion
Route::group(array('before' => 'authAdmin'), function()
{
    Route::get('/admin', array('as' => 'indexBack', 'uses' => 'BackController@index'));
    
    // Mon compte
    Route::get('/admin/account', array('as' => 'accountAdmin', 'uses' => 'BackController@account'));
    Route::post('/admin/account', array('as' => 'updateAdmin', 'uses' => 'AdminLoginController@updateAdmin'));
    
    // Routes des actualités
    // Controller : AdminActualiteController
    Route::post('/admin/actualites/new', array('as' => 'actualiteStore', 'uses' => 'AdminActualiteController@storeActualite'));
    Route::get('/admin/actualites/delete/{id}', array('as' => 'actualiteDelete', 'uses' => 'AdminActualiteController@deleteActualite'));
    Route::post('/admin/actualites/{id}', array('as' => 'actualiteUpdate', 'uses' => 'AdminActualiteController@updateActualite'));
    Route::get('/admin/actualites/new', array('as' => 'actualiteNew', 'uses' => 'AdminActualiteController@newActualite'));
    Route::get('/admin/actualites/{id}', array('as' => 'actualiteEdit', 'uses' => 'AdminActualiteController@editActualite'));
    Route::get('/admin/actualites', array('as' => 'actualitesAdmin', 'uses' => 'AdminActualiteController@actualites'));
    
    // Routes des infos trafic
    // Controller : AdminInfoController
    Route::post('/admin/infostrafic/new', array('as' => 'infostraficStore', 'uses' => 'AdminInfoController@storeInfotrafic'));
    Route::get('/admin/infostrafic/delete/{id}', array('as' => 'infostraficDelete', 'uses' => 'AdminInfoController@deleteInfotrafic'));
    Route::post('/admin/infostrafic/{id}', array('as' => 'infostraficUpdate', 'uses' => 'AdminInfoController@updateInfotrafic'));
    Route::get('/admin/infostrafic/new', array('as' => 'infostraficNew', 'uses' => 'AdminInfoController@newInfotrafic'));
    Route::get('/admin/infostrafic/{id}', array('as' => 'infostraficEdit', 'uses' => 'AdminInfoController@editInfotrafic'));
    Route::get('/admin/infostrafic', array('as' => 'infostraficAdmin', 'uses' => 'AdminInfoController@infotrafic'));
    
    // Route gestion FAQ
    // Controller : AdminFaqController
    Route::get('/admin/faq', array('as' => 'adminFaq', 'uses' => 'AdminFaqController@faq'));
    Route::get('/admin/faq/new', array('as' => 'newQuestion', 'uses' => 'AdminFaqController@newQuestion'));
    Route::post('/admin/faq/new', array('as' => 'storeQuestion', 'uses' => 'AdminFaqController@storeQuestion'));
    Route::get('/admin/faq/delete/{id}', array('as' => 'deleteQuestion', 'uses' => 'AdminFaqController@deleteQuestion'));
    Route::post('/admin/faq/{id}', array('as' => 'updateQuestion', 'uses' => 'AdminFaqController@updateQuestion'));
    Route::get('/admin/faq/{id}', array('as' => 'editQuestion', 'uses' => 'AdminFaqController@editQuestion'));
    
    // Route gestion administrateurs
    // Controller : AdministratorsController
    Route::get('/admin/users', array('as' => 'adminUser', 'uses' => 'AdministratorsController@users'));
    Route::post('/admin/users/new', array('as' => 'storeUser', 'uses' => 'AdministratorsController@storeUser'));
    Route::get('/admin/users/new', array('as' => 'newUser', 'uses' => 'AdministratorsController@newUser'));
    Route::get('/admin/users/delete/{id}', array('as' => 'deleteUser', 'uses' => 'AdministratorsController@deleteUser'));
    
    // Route gestion des chauffeurs
    // Controller : AdminChauffeurController
    Route::get('/admin/chauffeurs', array('as' => 'adminChauffeurs', 'uses' => 'AdminChauffeurController@chauffeurs'));
    Route::get('/admin/chauffeurs/new', array('as' => 'newChauffeur', 'uses' => 'AdminChauffeurController@newChauffeur'));
    Route::post('/admin/chauffeurs/new', array('as' => 'storeChauffeur', 'uses' => 'AdminChauffeurController@storeChauffeur'));
    Route::get('/admin/chauffeurs/delete/{id}', array('as' => 'deleteChauffeur', 'uses' => 'AdminChauffeurController@deleteChauffeur'));
    Route::get('/admin/chauffeurs/{id}', array('as' => 'editChauffeur', 'uses' => 'AdminChauffeurController@editChauffeur'));
    Route::post('/admin/chauffeurs/{id}', array('as' => 'updateChauffeur', 'uses' => 'AdminChauffeurController@updateChauffeur'));
    
    // Route gestion des utilisateurs
    // Controller : AdminUtilisateurController
    Route::get('/admin/utilisateurs', array('as' => 'adminUtilisateurs', 'uses' => 'AdminUtilisateurController@utilisateurs'));
    Route::get('/admin/utilisateurs/delete/{id}', array('as' => 'deleteUtilisateur', 'uses' => 'AdminUtilisateurController@deleteUtilisateur'));
    
    // Route gestion des questions
    // Controller : QuestionsController
    Route::get('/admin/questions', array('as' => 'adminQuestions', 'uses' => 'QuestionsController@questions'));
    Route::get('/admin/questions/{id}', array('as' => 'answerQuestions', 'uses' => 'QuestionsController@answerQuestions'));
    Route::get('/admin/questions/lue/{id}', array('as' => 'markAsReadQuestions', 'uses' => 'QuestionsController@markAsRead'));
    Route::get('/admin/questions/delete/{id}', array('as' => 'deleteQuestions', 'uses' => 'QuestionsController@deleteQuestions'));
    
    // Route gestion des liens utiles
    // Controller: AdminLiensController
    Route::get('/admin/liensutiles', array('as' => 'adminLiens', 'uses' => 'AdminLiensController@liens'));
    Route::get('/admin/liensutiles/new', array('as' => 'newLien', 'uses' => 'AdminLiensController@newLien'));
    Route::post('/admin/liensutiles/new', array('as' => 'storeLien', 'uses' => 'AdminLiensController@storeLien'));
    Route::get('/admin/liensutiles/delete/{id}', array('as' => 'deleteLien', 'uses' => 'AdminLiensController@deleteLien'));
    Route::get('/admin/liensutiles/{id}', array('as' => 'editLien', 'uses' => 'AdminLiensController@editLien'));
    Route::post('/admin/liensutiles/{id}', array('as' => 'updateLien', 'uses' => 'AdminLiensController@updateLien'));
    
    // Route gestion des lieux
    // Controller : AdminLieuController
    Route::get('/admin/lieux', array('as' => 'adminLieux', 'uses' => 'AdminLieuController@lieux'));
    Route::get('/admin/lieux/new', array('as' => 'newLieux', 'uses' => 'AdminLieuController@newLieux'));
    Route::post('/admin/lieux/new', array('as' => 'storeLieux', 'uses' => 'AdminLieuController@storeLieux'));
    Route::get('/admin/lieux/newcat', array('as' => 'newCat', 'uses' => 'AdminLieuController@newCat'));
    Route::post('/admin/lieux/newcat', array('as' => 'storeCat', 'uses' => 'AdminLieuController@storeCat'));
    Route::get('/admin/lieux/delete/{id}', array('as' => 'deleteLieux', 'uses' => 'AdminLieuController@deleteLieux'));
    Route::get('/admin/lieux/{id}', array('as' => 'editLieux', 'uses' => 'AdminLieuController@editLieux'));
    Route::get('/admin/cat/{id}', array('as' => 'editCat', 'uses' => 'AdminLieuController@editCat'));
    Route::post('/admin/lieux/{id}', array('as' => 'updateLieux', 'uses' => 'AdminLieuController@updateLieux'));
    Route::post('/admin/cat/{id}', array('as' => 'updateCat', 'uses' => 'AdminLieuController@updateCat'));
    
    // Route gestion des lignes
    // Controller AdminLignesController
    Route::get('/admin/lignes', array('as' => 'adminLignes', 'uses' => 'AdminLignesController@lignes'));
    Route::get('/admin/lignes/generateLines', array('as' => 'generateLines', 'uses' => 'AdminLignesController@generateLines'));
    Route::get('/admin/lignes/updatePolys', array('as' => 'updatePolys', 'uses' => 'AdminLignesController@updatePolys'));
    Route::get('/admin/lignes/{id}', array('as' => 'editLignes', 'uses' => 'AdminLignesController@edit'));
    Route::post('/admin/lignes/{id}', array('as' => 'updateLignes', 'uses' => 'AdminLignesController@update'));
    
    // Route gestion des pages statiques
    // Controller AdminPagesController
    Route::get('/admin/pages', array('as' => 'adminPages', 'uses' => 'AdminPagesController@pages'));
    Route::get('/admin/pages/new', array('as' => 'adminPagesNew', 'uses' => 'AdminPagesController@newPage'));
    Route::post('/admin/pages/new', array('as' => 'adminPagesStore', 'uses' => 'AdminPagesController@storePage'));
    Route::get('/admin/pages/{id}', array('as' => 'editPage', 'uses' => 'AdminPagesController@editPage'));
    Route::post('/admin/pages/{id}', array('as' => 'updatePage', 'uses' => 'AdminPagesController@updatePage'));
    Route::get('/admin/pages/delete/{id}', array('as' => 'deletePage', 'uses' => 'AdminPagesController@deletePage'));
    
    // Route gestion du slider
    // Controller AdminSliderController
    Route::get('/admin/slider', array('as' => 'adminSlider', 'uses' => 'AdminSliderController@slider'));
    Route::post('/admin/slider', array('as' => 'storeSlider', 'uses' => 'AdminSliderController@storeSlider'));
    Route::post('/admin/slider/updatePos', array('as' => 'updatePos', 'uses' => 'AdminSliderController@updatePos'));
    Route::post('/admin/slider/updateValues', array('as' => 'updateValues', 'uses' => 'AdminSliderController@updateValues'));
    Route::post('/admin/slider/deleteSlide', array('as' => 'deleteSlide', 'uses' => 'AdminSliderController@deleteSlide'));
    
    // Route gestion du arret
    // Controller AdminArretController
    Route::get('/admin/arret', array('as' => 'adminArret', 'uses' => 'AdminArretController@arret'));
    Route::get('/admin/arret/new', array('as' => 'adminArretNew', 'uses' => 'AdminArretController@newArret'));
    Route::post('/admin/arret/new', array('as' => 'adminArretStore', 'uses' => 'AdminArretController@storeArret'));
    Route::get('/admin/arret/{id}', array('as' => 'editArret', 'uses' => 'AdminArretController@editArret'));
    Route::post('/admin/arret/{id}', array('as' => 'updateArret', 'uses' => 'AdminArretController@updateArret'));
    Route::get('/admin/arret/delete/{id}', array('as' => 'deleteArret', 'uses' => 'AdminArretController@deleteArret'));
    
    // Route gestion des horaires
    // Controller AdminHoraireController
    Route::get('/admin/horaire', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@horaire'));
    Route::get('/admin/horaire/new', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@newHoraire'));
    Route::get('/admin/horaire/selectLine', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@selectLineToUpdate'));
    Route::get('/admin/horaire/update', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@findByLigne'));
    Route::post('/admin/horaire/update', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@updateHoraire'));
    Route::get('/admin/horaire/delType/{id}', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@deleteTypeSemaine'));
    Route::post('/admin/horaire/addType', array('as' => 'adminHoraire', 'uses' => 'AdminHoraireController@storeTypeSemaine'));
    
    
    
});

                                    // ─────────▄──────────────▄
                                    // ────────▌▒█───────────▄▀▒▌
                                    // ────────▌▒▒▀▄───────▄▀▒▒▒▐
                                    // ───────▐▄▀▒▒▀▀▀▀▄▄▄▀▒▒▒▒▒▐
                                    // ─────▄▄▀▒▒▒▒▒▒▒▒▒▒▒█▒▒▄█▒▐
                                    // ───▄▀▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▀██▀▒▌
                                    // ──▐▒▒▒▄▄▄▒▒▒▒▒▒▒▒▒▒▒▒▒▀▄▒▒▌
                                    // ──▌▒▒▐▄█▀▒▒▒▒▄▀█▄▒▒▒▒▒▒▒█▒▐
                                    // ─▐▒▒▒▒▒▒▒▒▒▒▒▌██▀▒▒▒▒▒▒▒▒▀▄▌                 SUCH ROUTES
                                    // ─▌▒▀▄██▄▒▒▒▒▒▒▒▒▒▒▒░░░░▒▒▒▒▌                     VERY MANY
                                    // ─▌▀▐▄█▄█▌▄▒▀▒▒▒▒▒▒░░░░░░▒▒▒▐                         WOW.
                                    // ▐▒▀▐▀▐▀▒▒▄▄▒▄▒▒▒▒▒░░░░░░▒▒▒▒▌                          EVANE MAS.
                                    // ▐▒▒▒▀▀▄▄▒▒▒▄▒▒▒▒▒▒░░░░░░▒▒▒▐
                                    // ─▌▒▒▒▒▒▒▀▀▀▒▒▒▒▒▒▒▒░░░░▒▒▒▒▌
                                    // ─▐▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▐
                                    // ──▀▄▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▄▒▒▒▒▌
                                    // ────▀▄▒▒▒▒▒▒▒▒▒▒▄▄▄▀▒▒▒▒▄▀
                                    // ───▐▀▒▀▄▄▄▄▄▄▀▀▀▒▒▒▒▒▄▄▀
                                    // ──▐▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▀▀