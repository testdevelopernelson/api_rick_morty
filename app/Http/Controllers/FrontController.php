<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller {

    public function home(Request $request){
         
          return view('pages.home');
    }

     public function our_company() {

          set_content(2);
          $corporate_values = CorporateValue::order();
          $breadcrumb = [
               array(
                    'title'   => __('menu.about_us'),
                    'url'     => false
               ) ,
               array(
                    'title'   => __('menu.our_company'),
                    'url'     => false
               )              
          ];
          return view('pages.our_company', compact('breadcrumb', 'corporate_values'));
     }

     public function our_history() {
          set_content(3);
          $breadcrumb = [
               array(
                    'title'   => __('menu.about_us'),
                    'url'     => false
               ) ,
               array(
                    'title'   => __('menu.our_history'),
                    'url'     => false
               )              
          ];
          return view('pages.our_history', compact('breadcrumb'));
     }

     public function contact(Request $request) {        
          set_content(4); 
          $departments = Department::with('cities')->get();
          $cities = City::orderBy('title')->get();
          $send_form = 0;
          $breadcrumb = [
               array(
                    'title'   => __('menu.contact'),
                    'url'     => false
               )  
          ];   
          if ($request->isMethod('POST')){
               $data = $request->all();
               if(!Recaptcha::validate($data['_recaptcha'])){
                    $send_form = -1;
               }else{ 
                    $this->setValidateContact($request);
                    foreach ($data as $key => $value) {
                         if ($key != '_token') {
                              $data[$key] = htmlspecialchars($value);
                         }
                    }
                    $send = Mail::send(new ContactMail($data));
                    if ($send == null) {
                         FormContact::create($data);
                         $send_form = 1;
                    }
               }
          }
          return view('pages.contact', compact('send_form', 'breadcrumb', 'departments', 'cities'));
     }

     public function responsability($slug = null) {
          set_content(5);
          $responsabilities = Responsability::published();
          $record = Responsability::where('slug', $slug)->firstOrFail();
          // dd($article);
          $breadcrumb = [
               array(
                    'title'   => __('menu.responsability'),
                    'url'     => false
               ), 
               array(
                    'title'   => $record->title,
                    'url'     => false
               )    
          ];
          set_seo($record);
          return view('pages.responsability', compact('breadcrumb', 'responsabilities', 'record'));
     }

     public function questions() {
          set_content(7);
          $questions = Question::published();
          $breadcrumb = [
               array(
                    'title'   => __('menu.questions'),
                    'url'     => false
               )    
          ];
          return view('pages.questions', compact('breadcrumb', 'questions'));
     }

     public function general_content($slug){
          $content = GeneralContent::where('slug', $slug)->firstOrFail();          
          $breadcrumb = [               
               array(
                    'title'   => $content->title,
                    'url'     => false
               )    
          ];
          return view('pages.general_content', compact('breadcrumb', 'content'));
     }

     public function pdfs($slug){
          // dd($slug);
          $content = GeneralContent::where('slug', $slug)->firstOrFail();
          // dd($content);
          $breadcrumb = [
               array(
                    'title'   => $content->title,
                    'url'     => false
               )    
          ];
          return view('pages.pdfs', compact('breadcrumb', 'content'));
     }

     public function articles(Request $request) {
          set_content(6); 
          $articles =  Article::published()->paginate(config('app.paginate_articles'));
          $breadcrumb = [
               array(
                    'title'   => __('menu.articles'),
                    'url'     => false
               )             
          ];
          if (request()->ajax()) {
               $view = view('_partials.articles', compact('articles'));
               $content = $view->render();
               $more_content = true;
               if ($articles->isEmpty()) {
                    $more_content = false;
               }
               return response()->json(compact('content', 'more_content'));
          }
          return view('pages.articles', compact('articles', 'breadcrumb'));
     }

     public function article($slug = null) {
          set_content(6);
          $article = Article::where('slug', $slug)->firstOrFail();
          // dd($article);
          $breadcrumb = [
               array(
                    'title'   => __('menu.articles'),
                    'url'     => route('articles')
               ), 
               array(
                    'title'   => $article->title,
                    'url'     => false
               )    
          ];
          set_months_large();
          set_seo($article);
          return view('pages.article', compact('breadcrumb', 'article'));
     }

    public function credit(Request $request, $slug = null, $tab = null) {
          set_content(7);
          $action = 'credit';
          $record = Credit::where('slug', $slug)->with('tabs')->firstOrFail();
          $departments = Department::with('cities')->get();
          if ($tab == null) {
               $contents = $record->tabs[0]->contents()->get();
          }else{
               $contents = CreditTab::where('slug', $tab)->with('contents')->first();
               $contents = $contents->contents()->get();
          }
          // dd($contents);
          $breadcrumb = [
               array(
                    'title'   => __('menu.credit'),
                    'url'     => false
               ) ,
               array(
                    'title'   => $record->title,
                    'url'     => false
               )              
          ];
          $send_form = 0;
          if ($request->isMethod('POST')){
               $data = $request->all();
               if(!Recaptcha::validate($data['_recaptcha'])){
                    $send_form = -1;
               }else{ 
                    $this->setValidateCreditSaving($request);
                    foreach ($data as $key => $value) {
                         if ($key != '_token') {
                              $data[$key] = htmlspecialchars($value);
                         }
                    }
                    $send = Mail::send(new CreditSavingMail($data));
                    if ($send == null) {
                         FormCreditSaving::create($data);
                         $send_form = 1;
                    }
               }
          }
          set_seo($record);
          return view('pages.credit', compact('breadcrumb', 'record', 'contents', 'tab', 'departments', 'action', 'send_form'));
    }

     public function saving(Request $request, $slug = null, $tab = null) {
          set_content(8);
          $record = Saving::where('slug', $slug)->with('tabs')->firstOrFail();
          $action = 'saving';
          $departments = Department::with('cities')->get();
          if ($tab == null) {
               $contents = $record->tabs[0]->contents()->get();
          }else{
               $contents = SavingTab::where('slug', $tab)->with('contents')->first();
               $contents = $contents->contents()->get();
          }
          // dd($contents);
          $breadcrumb = [
               array(
                    'title'   => __('menu.saving'),
                    'url'     => false
               ) ,
               array(
                    'title'   => $record->title,
                    'url'     => false
               )              
          ];
          $send_form = 0;
          if ($request->isMethod('POST')){
               $data = $request->all();
               if(!Recaptcha::validate($data['_recaptcha'])){
                    $send_form = -1;
               }else{ 
                    $this->setValidateCreditSaving($request);
                    foreach ($data as $key => $value) {
                         if ($key != '_token') {
                              $data[$key] = htmlspecialchars($value);
                         }
                    }
                    $send = Mail::send(new CreditSavingMail($data));
                    if ($send == null) {
                         FormCreditSaving::create($data);
                         $send_form = 1;
                    }
               }
          }
          set_seo($record);
          return view('pages.saving', compact('breadcrumb', 'record', 'contents', 'tab', 'departments', 'action', 'send_form'));
     }

     public function benefit($slug = null, $tab = null) {
          set_content(9);
          $articles = array();
          $record = Benefit::where('slug', $slug)->with('tabs')->firstOrFail();
          if ($record->title == 'Educación cooperativa') {
               $articles = Article::orderBy('date', 'DESC')->where('published', 1)->where('menu_blog_id', 4)->get();
               set_months_large();
          }
          if ($tab == null) {
               $contents = $record->tabs[0]->contents()->get();
          }else{
               $contents = BenefitTab::where('slug', $tab)->with('contents')->first();
               $contents = $contents->contents()->get();
          }
          // dd($contents);
          $breadcrumb = [
               array(
                    'title'   => __('menu.benefit'),
                    'url'     => false
               ) ,
               array(
                    'title'   => $record->title,
                    'url'     => false
               )              
          ];
          // dd($articles);
          set_seo($record);
          return view('pages.benefits', compact('breadcrumb', 'record', 'contents', 'tab', 'articles'));
     }

     public function credit_simulator(Request $request){
          set_content(13);
          $sedes = Headquarter::orderBy('title')->get();
          $types = MasterSimulator::order('credit', 'modalities');
          $ocupations = MasterSimulator::order('credit', 'ocupations');
          $guarantee = MasterSimulator::order('credit', 'guarantee');
          $way_to_pay = MasterSimulator::order('credit', 'way_to_pay');
          $variable_calculate = MasterSimulator::order('credit', 'variable_calculate');
          $master_simulator['types'] = $types;
          $master_simulator['ocupations'] = $ocupations;
          $master_simulator['way_to_pay'] = $way_to_pay;
          $master_simulator['variable_calculate'] = $variable_calculate;
          $master_simulator = json_encode($master_simulator);
          $messages = json_encode(__('messages_simulator'));
          $breadcrumb = [
               array(
                    'title'   => __('menu.credit_simulator'),
                    'url'     => false
               )            
          ];
          $send_form = 0;
          if ($request->isMethod('POST')){
               $data = $request->all();
               if(!Recaptcha::validate($data['_recaptcha'])){
                    $send_form = -1;
               }else{                    
                    // dd($data);
                    $this->setValidateSimulator($request);
                    $data['value_credit'] = !empty($data['value_credit']) ? (new Simulator)->getSeparatorMask($data['value_credit'], '.') : 0;
                    $data['monthly_fee'] =  !empty($data['monthly_fee']) ? (new Simulator)->getSeparatorMask($data['monthly_fee'], '.') : 0;
                    foreach ($data as $key => $value) {
                         if ($key != '_token') {
                              $data[$key] = htmlspecialchars($value);
                         }
                    }
                    $warranty = MasterSimulator::where('id', $data['warranty'])->first();
                    $data['warranty'] = $warranty->name;
                    $send =Mail::send(new CreditSimulatorMail($data));
                    if ($send == null) {   
                         $agency = Headquarter::where('id', $data['agency'])->first();
                         $data['agency'] = $agency->title;              
                         FormCreditSimulator::create($data);
                         $send_form = 1;
                    }
               }
          }
          return view('pages.credit_simulator', compact('breadcrumb', 'sedes', 'send_form', 'messages', 'types', 'ocupations', 'guarantee', 'master_simulator'));
     }

     public function saving_simulator(Request $request){
          set_content(12);
          $sedes = Headquarter::orderBy('title')->get();
          $products = MasterSimulator::order('saving', 'products');
          $periods = MasterSimulator::order('saving', 'periods');
          $messages = json_encode(__('messages_simulator'));
          // dd(json_encode($messages));
          $breadcrumb = [
               array(
                    'title'   => __('menu.saving_simulator'),
                    'url'     => false
               )            
          ];
          $send_form = 0;
          if ($request->isMethod('POST')){
               $data = $request->all();
               if(!Recaptcha::validate($data['_recaptcha'])){
                    $send_form = -1;
               }else{                    
                    // dd($data);
                    $this->setValidateSimulator($request);
                    $data['value'] = (new Simulator)->getSeparatorMask($data['value'], '.');
                    foreach ($data as $key => $value) {
                         if ($key != '_token') {
                              $data[$key] = htmlspecialchars($value);
                         }
                    }
                    $send =Mail::send(new SavingSimulatorMail($data));
                    if ($send == null) {   
                         $agency = Headquarter::where('id', $data['agency'])->first();
                         $data['agency'] = $agency->title;                
                         FormSavingSimulator::create($data);
                         $send_form = 1;
                    }
               }
          }
          return view('pages.saving_simulator', compact('breadcrumb', 'sedes', 'send_form', 'products', 'periods', 'messages'));
     }
     // Función links de interés
     public function quick_access($slug, $slug_menu = null, $slug_tab = null) {       
          $record = QuickAccess::where('slug', $slug)->with('menus')->firstOrFail();
          $section = Section::with('contents')->find(2);
          $menu = '';
          $tab = '';
          $section->contents[0]->image_1 = $record->image_banner;
          $section->contents[0]->text_1 = $record->title_banner;
          if ($record->has_menu) { //Si tiene menús
               $menu_lateral = $record->menus()->get();
               if ($slug_menu == null) {   //Se ingresó directamente desde el home                  
                    $contents = $menu_lateral[0]->tabs[0]->contents()->get();
                    $breadcrumb = [
                         array(
                              'title'   => $record->title,
                              'url'     => false
                         ) ,
                         array(
                              'title' => $menu_lateral[0]->title,
                              'url' => false
                         )
                    ]; 
               }else{//Se le dió clic en un menú lateral
                    $menu = QuickAccessMenu::where('slug', $slug_menu)->with('tabs')->firstOrFail();
                    $breadcrumb = [
                         array(
                              'title'   => $record->title,
                              'url'     => false
                         ) ,
                         array(
                              'title' => $menu->title,
                              'url' => false
                         )
                    ];
                    if ($menu->has_tab) { //El menú tiene tabs
                         if ($slug_tab == null) { // El menú tiene tabs pero aún no se le da clic en uno
                              $contents = $menu->tabs[0]->contents()->get();
                              $breadcrumb = [
                                   array(
                                        'title'   => $record->title,
                                        'url'     => false
                                   ) ,
                                   array(
                                        'title' => $menu->title,
                                        'url' => false
                                   )
                              ]; 
                         }else{//Clic en un tab del menú seleccionado
                              $tab = QuickAccessTab::where('slug', $slug_tab)->with('contents')->firstOrFail();
                              $contents = $tab->contents()->get();
                              $breadcrumb = [
                                   array(
                                        'title'   => $record->title,
                                        'url'     => false
                                   ) ,
                                   array(
                                        'title' => $menu->title,
                                        'url' => route('quick_access.menu', [$record->slug, $menu->slug])
                                   ),
                                   array(
                                        'title' => $tab->title,
                                        'url' => false
                                   )
                              ];
                         }
                    }else{//El menú no tiene tabs
                        $contents = $menu->tabs[0]->contents()->get() ;
                    }
               }
          }else{//EL enlace de interés no tiene menus ni tabs, directamente se carga el contenido
              $contents = $record->menus[0]->tabs[0]->contents()->get();
              $breadcrumb = [
                    array(
                         'title'   => $record->title,
                         'url'     => false
                    )  
               ];   
          }
          // dd($menu);
          
          return view('pages.quick_access', compact('section', 'breadcrumb', 'contents', 'record', 'tab', 'menu'));
     }

     public function pqrs(Request $request){
          set_content(14); 
          $departments = Department::with('cities')->get();
          $cities = City::orderBy('title')->get();     
          $receive_reply_by = explode(',', __('selects.receive_reply_by'));   
          $type_request = explode(',', __('selects.type_request'));   
          $send_form = 0;
          $validate_document = false;
          $breadcrumb = [
               array(
                    'title'   => __('menu.work_us'),
                    'url'     => false
               )  
          ];   
          $send_form = 0;
          $message_send = 0;
          if ($request->isMethod('POST')){
               $data = $request->all();
               if(!Recaptcha::validate($data['_recaptcha'])){
                    $send_form = -1;
               }else{ 
                    // $this->setValidatePqrs($request);
                    foreach ($data as $key => $value) {
                         if ($key != '_token' && $key != '_files') {
                              $data[$key] = htmlspecialchars($value);
                         }
                    }
                    $send = Mail::send(new PqrsMail($data));
                    if ($send == null) {
                         $object = PqrsForm::create($data);
                         if (isset($data['_files'])) {
                             foreach ($data['_files'] as $key => $file) {
                                   $data = ['file_'. ($key+1) => \FlipUpload::save($file, 'pqrsform')];
                                   $object->update($data);
                             }
                         }
                         $message_send = __('messages.send_pqrs') . ': ' . $object->id;
                         $send_form = 1;
                    }
               }    
          } 
          return view('pages.pqrs', compact('breadcrumb', 'departments', 'receive_reply_by', 'type_request', 'cities', 'send_form', 'message_send'));
     }

     public function fogacoop(){
          set_content(10); 
          $breadcrumb = [
               array(
                    'title'   => __('menu.fogacoop'),
                    'url'     => false
               )  
          ];
          return view('pages.fogacoop', compact('breadcrumb'));
     }

     public function data_update(){
          set_content(11); 
          $breadcrumb = [
               array(
                    'title'   => __('menu.data_update'),
                    'url'     => false
               )  
          ];
          return view('pages.data_update', compact('breadcrumb'));
     }

     public function search(Request $request){
          set_content(15);
          $collection = collect();
          $breadcrumb = [
               array(
                    'title'   => __('menu.search'),
                    'url'     => false
               )  
          ];
          $term = $request->get('term');
          $breadcrumb = [
               array(
                    'title'   => __('menu.search'),
                    'url'     => false
               ) ,
               array(
                    'title'   => $term,
                    'url'     => false
               )
          ];
          $records = Section::where('seo', 1)
               ->where(function ($q) use ($term) {
              $q->where('name', 'LIKE', "%$term%")
                  ->orWhere('meta_title', 'LIKE', "%$term%")
                  ->orWhere('meta_description', 'LIKE', "%$term%");
               })->get();
          foreach ($records as $key => $value) {
               $route = $this->sectionValidate($value->id);
               if ($route != '') {
                    $collection->push([
                         'title' => $value->name,
                         'text' => $value->meta_description,
                         'url' => $route
                    ]);
               }
          }
          
          $model = 'App\Models\CreditContent';
          $colecction = $this->searchTables($model, $term, 'credit', $collection, __('menu.credit'));
          $model = 'App\Models\SavingContent';
          $colecction = $this->searchTables($model, $term, 'saving', $collection, __('menu.saving'));
          $model = 'App\Models\BenefitContent';
          $colecction = $this->searchTables($model, $term, 'benefit', $collection, __('menu.benefits'));
          $model = 'App\Models\CorporateContent';
          $colecction = $this->searchTables($model, $term, 'about_us', $collection, __('menu.about_us'));

          $records = QuickAccessContent::where(function ($q) use ($term) {
               $q->where('title', 'LIKE', "%$term%")
               ->orWhere('title_accordion', 'LIKE', "%$term%")
               ->orWhere('text', 'LIKE', "%$term%")
               ->orWhere('text_accordion', 'LIKE', "%$term%")
               ->orWhere('list', 'LIKE', "%$term%")
               ->orWhere('table', 'LIKE', "%$term%")
               ->orWhere('title_pdf', 'LIKE', "%$term%");
          })->with('tab')->get();
          $array = array();
          foreach ($records as $key => $value) {
               if ($value->tab->menu->link->published) { //Si el links está pubicado
                    if (!in_array($value->tab_id, $array)) {
                         if ($value->tab->menu->link->has_menu) { //Si el link tiene menu
                              if ($value->tab->menu->has_tab) { //Si el menu tiene tabs
                                   $title = $value->tab->menu->link->title . ' | ' . $value->tab->title;
                                   $route = route('quick_access.tab' ,[$value->tab->menu->link->slug, $value->tab->menu->slug, $value->tab->slug]);
                              }else{ //El menu no tiene tabas
                                   $title = $value->tab->menu->link->title . ' | ' .  $value->tab->menu->title;
                                   $route = route('quick_access.menu',[$value->tab->menu->link->slug, $value->tab->menu->slug]);                              
                              }                              
                         }else{ //El link no tiene menu
                              $title = $value->tab->menu->link->title;
                              $route = route('quick_access', $value->tab->menu->link->slug);
                         }
                         $collection->push([
                              'title' => $title,
                              'text' => $value->tab->menu->link->meta_description,
                              'url' => $route
                         ]);
                         $array[] = $value->tab_id;
                    } 
               }                            
          }

          $records = Article::where('published', 1)
               ->where(function ($q) use ($term) {
               $q->where('title', 'LIKE', "%$term%")
               ->orWhere('text_intro', 'LIKE', "%$term%")
               ->orWhere('text_single_1', 'LIKE', "%$term%")
               ->orWhere('text_single_2', 'LIKE', "%$term%")
               ->orWhere('details', 'LIKE', "%$term%")
               ->orWhere('meta_description', 'LIKE', "%$term%");
          })->with('section')->get();
          foreach ($records as $key => $value) {
               if ($value->published && $value->section->published) {
                    $collection->push([
                         'title' => $value->section->title . ' | ' . $value->title,
                         'text' => $value->text_intro,
                         'url' => route('article', [$value->section->slug, $value->slug])
                    ]);
               }               
          }
          
          // dd($collection);
          return view('pages.search', compact('breadcrumb', 'collection'));
     }

    public function send_newsletter(){
        if (request()->ajax()) {
            $data = request()->all();
            $email = $data['email'];
            $sw = 1;
            $record = FormNewsletter::whereEmail($email)->get();
            if (count($record) > 0) {
                $sw = -1;
            }else{
                $response = Mail::to(config('settings.email_newsletter'))->send(new SendNewsletter($data));
                if($response != null){
                   $sw = 0; 
                } 
                FormNewsletter::create($data);
            }
            
            return response()->json(['status' => $sw]);
        }
    }

     private function setValidateCourse($request){
          $validatedData = $request->validate(
               [
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required'

               ],
               [
                    'name.required' => __('messages.required_name'),
                    'lastname.required' => __('messages.required_lastname'),
                    'email.required' => __('messages.required_email'),
                    'email.email' => __('messages.email_invalid'),   
                    'phone.required' => __('messages.required_phone')

               ]
          );       
     }

     private function setValidateContact($request){
          $validatedData = $request->validate(
               [
                    'cooperative_relation' => 'required',
                    'name' => 'required',
                    'lastname' => 'required',
                    'type_document' => 'required',
                    'document' => 'required',
                    'email' => 'required|email',
                    'phone' => 'numeric',
                    'mobile' => 'required|numeric',
                    'city' => 'required',
                    'reason_contact' => 'required'

               ],
               [
                    'cooperative_relation.required' => __('messages.required_cooperative_relation'),
                    'name.required' => __('messages.required_name'),
                    'lastname.required' => __('messages.required_lastname'),
                    'type_document.required' => __('messages.required_type_document'),
                    'document.required' => __('messages.required_document'),
                    'email.required' => __('messages.required_email'),
                    'email.email' => __('messages.email_invalid'),   
                    'phone.numeric' => __('messages.numeric_phone'),
                    'mobile.required' => __('messages.required_mobile'),
                    'mobile.numeric' => __('messages.numeric_mobile'),
                    'department.required' => __('messages.required_department'),
                    'city.required' => __('messages.required_city'),
                    'reason_contact.required' => __('messages.required_reason_contact')

               ]
          );       
     }

     private function setValidateSimulator($request){
          $validatedData = $request->validate(
               [
                    'name' => 'required',
                    'lastname' => 'required',
                    'document' => 'required',
                    'email' => 'required|email',
                    'mobile' => 'required|numeric',
                    'agency' => 'required',

               ],
               [
                    'name.required' => __('messages.required_name'),
                    'lastname.required' => __('messages.required_lastname'),
                    'document.required' => __('messages.required_document'),
                    'email.required' => __('messages.required_email'),
                    'email.email' => __('messages.email_invalid'),   
                    'mobile.required' => __('messages.required_mobile'),
                    'mobile.numeric' => __('messages.numeric_mobile'),
                    'agency.required' => __('messages.required_agency')

               ]
          );       
     }

     private function setValidateCreditSaving($request){
          $validatedData = $request->validate(
               [
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'department' => 'required',
                    'city' => 'required',

               ],
               [
                    'name.required' => __('messages.required_name'),
                    'lastname.required' => __('messages.required_lastname'),
                    'email.required' => __('messages.required_email'),
                    'email.email' => __('messages.email_invalid'),   
                    'phone.required' => __('messages.required_phone'),
                    'phone.numeric' => __('messages.numeric_phone'),
                    'department.required' => __('messages.required_department'),
                    'city.required' => __('messages.required_city')

               ]
          );       
     }

     private function setValidateWorkUs($request){
          $validatedData = $request->validate(
               [                    
                    'document' => 'required',
                    'position' => 'required',
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email', 
                    'vinculo' =>'required|in:Si,No',
                    'experience' =>'required|in:Si,No',
                    'mobile' => 'required|numeric',
                    'department' => 'required',
                    'city' => 'required',
                    'scholarship' => 'required',
                    'training' => 'required',
                    'file' => 'required|mimes:jpeg,doc,docx,pdf|max:20480',

               ],
               [
                    'position.required' => __('messages.required_position'),
                    'name.required' => __('messages.required_name'),
                    'lastname.required' => __('messages.required_lastname'),
                    'document.required' => __('messages.required_document'),
                    'email.required' => __('messages.required_email'),
                    'email.email' => __('messages.email_invalid'),   
                    'vinculo.required' => __('messages.selected_vinculo'),   
                    'experience.required' => __('messages.selected_experience'),   
                    'phone.required' => __('messages.required_phone'),
                    'mobile.required' => __('messages.required_mobile'),
                    'mobile.numeric' => __('messages.numeric_mobile'),
                    'department.required' => __('messages.required_department'),
                    'city.required' => __('messages.required_city'),
                    'scholarship.required' => __('messages.required_scholarship'),
                    'training.required' => __('messages.required_training'),
                    'file.required' => __('messages.required_file'),
                    'file.mimes' => __('messages.mimes_file'),
                    'file.max' => __('messages.size_file'),

               ]
          );       
     }

     private function setValidatePqrs($request){
          $validatedData = $request->validate(
               [                    
                    'type_document' => 'required',
                    'document' => 'required',
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email', 
                    'vinculo' =>'required|in:Si,No',
                    'address' =>'required',
                    'mobile' => 'required|numeric',
                    'department' => 'required',
                    'city' => 'required',
                    'reply_by' => 'required',
                    'type_request' => 'required',
                    'file' => 'required|mimes:jpeg,doc,docx,pdf|max:3000',

               ],
               [
                    'type_document.required' => __('messages.required_type_document'),
                    'position.required' => __('messages.required_position'),
                    'name.required' => __('messages.required_name'),
                    'lastname.required' => __('messages.required_lastname'),
                    'document.required' => __('messages.required_document'),
                    'email.required' => __('messages.required_email'),
                    'email.email' => __('messages.email_invalid'),   
                    'vinculo.required' => __('messages.selected_vinculo'),
                    'address.required' => __('messages.required_address'),
                    'mobile.required' => __('messages.required_mobile'),
                    'mobile.numeric' => __('messages.numeric_mobile'),
                    'department.required' => __('messages.required_department'),
                    'city.required' => __('messages.required_city'),
                    'reply_by.required' => __('messages.required_reply_by'),
                    'type_request.required' => __('messages.required_type_request'),
                    'file.required' => __('messages.required_file'),
                    'file.mimes' => __('messages.mimes_file'),
                    'file.max' => __('messages.size_file'),

               ]
          );       
     }

     private function validateDocument($document){
          $response = false;
          $records = FormWorkUs::where('document', $document)->get();
          if (count($records) > 0) {
               $date_now = date('Y-m-d');
               foreach ($records as $key => $value) {
                    $date_created = date('Y-m-d', strtotime($value->created_at));
                    // echo ($date_now) . '<br>';
                    // echo ($date_created) . '<br>';
                    if ($date_created == $date_now) {
                         $response = true;
                         break;
                    }
               }  
          }
          return $response;
     }

     private function sectionValidate($section){
          $route = '';
          switch ($section) {
               case 4:
                   $route = route('contact');
                    break;
               case 5:
                    $route = route('work_us');
                     break;
               case 10:
                    $route = route('fogacoop');
                    break;
               case 11:
                    $route = route('data_update');
                    break;
               case 12:
                    $route = route('saving_simulador');
                    break;
               case 13:
                    $route = route('credit_simulador');
                    break;
               case 13:
                    $route = route('pqrs');
                    break;   
          }
          return $route;
     }

     private function searchTables($model, $term, $route_, $collection, $menu){
          $records = $model::where(function ($q) use ($term) {
               $q->where('title', 'LIKE', "%$term%")
               ->orWhere('title_accordion', 'LIKE', "%$term%")
               ->orWhere('text', 'LIKE', "%$term%")
               ->orWhere('text_accordion', 'LIKE', "%$term%")
               ->orWhere('list', 'LIKE', "%$term%")
               ->orWhere('table', 'LIKE', "%$term%")
               ->orWhere('title_pdf', 'LIKE', "%$term%");
               })->with('tab')->get();
           $array = array();
          foreach ($records as $key => $value) {
               if ($value->tab->menu->published) {
                    if (!in_array($value->tab_id, $array)) {
                         if ($value->tab->menu->has_tab) {
                              $title = $menu . ' | ' .$value->tab->title;
                              $route = route($route_ .'.tab',[$value->tab->menu->slug, $value->tab->slug]);
                         }else{
                              $title = $menu . ' | ' .$value->tab->menu->title;
                              $route = route($route_, $value->tab->menu->slug);
                         }
                         $collection->push([
                              'title' => $title,
                              'text' => $value->tab->menu->meta_description,
                              'url' => $route
                         ]);
                         $array[] = $value->tab_id;
                    } 
               }
                            
          }
          return $collection;
     }
     
}
