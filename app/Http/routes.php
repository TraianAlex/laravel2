<?php
//get() put() delete() post()

Route::get('milkshakes/{flavor?}', 'MilkshakeController@index');

Route::controller('portfolio', 'PortfolioController');

Route::resource('recipes', 'RecipeController');

Route::get('about_us', 'HomeController@showAbout');
Route::get('rest_resource', 'HomeController@showWelcome');

/************************************************************************************/

Route::group(['middleware' => 'auth'], function () {

    Route::get('account/sign-out', [
        'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
    ]);

    Route::post('account/change-password', [
        'as' => 'account-change-password-post',
		'uses' => 'AccountController@postChangePassword'
    ]);

    Route::get('account/change-passoword', [
        'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
    ]);
});

Route::group(['middleware' => 'guest'], function () {

    Route::get('account/create', [
        'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
    ]);

    Route::post('account/create', [
    	'as' => 'account-create-post',
		'uses' => 'AccountController@postCreate'
	]);

	Route::post('account/sign-in', [
		'as' => 'account-sign-in-post',
		'uses' => 'AccountController@postSignIn'
	]);

	Route::get('account/sign-in', [
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	]);

	Route::get('account/activate/{code}', [
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
	]);

	Route::post('account/forgot-password', [
		'as' => 'account-forgot-password-post',
		'uses' => 'AccountController@postForgotPassword'
	]);

	Route::get('account/forgot-password', [
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	]);

	Route::get('account/recover/{code}', [
		'as' => 'account-recover',
		'uses' => 'AccountController@getRecover'
	]);
});

Route::get('user/{username}', [
        'as' => 'profile-user',
		'uses' => 'ProfileController@user'
]);

Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@home'
]);

/*****************************************************************************/

Route::get('faker', function(){
	$faker = Faker\Factory::create();//'fr_FR'//nl_NL//ja_JP
	for ($i=0; $i < 10; $i++) { 
		var_dump($faker->firstName.' '.$faker->lastName);
	}
});

/*********************************************************************************/

Route::post('validation', function()
{
	$rules = array(
		'name' => 'required',
		'link' => 'required|url',
		'password' => 'required|min:8',
		'password-repeat' => 'required|same:password'
	);

	$validator = Validator::make(Input::all(), $rules);

	if ($validator->fails()) {
		return Redirect::to('home')->withInput()->withErrors($validator->messages());
	}

	return 'Form was submitted';
});

/***********************************************************************************/

Route::get('comment', function()
{
	// Grabbing the article of a particular comment
	$article = App\Comment::find(7)->article;
	dd($article->title);

	// Grabbing the comments for a particular article
	$comments = App\Article::find(4)->comments;//->where('body', '>', 50)->get();
	foreach ($comments as $comment) {
		var_dump($comment->body);
	}
});

Route::get('article2', function()
{
	/*
		DELETING ARTICLES
	*/
	// deleting multiple articles
	$victims = App\Article::where('id', '<', 3);
	$victims->delete();
	return 'Mass delete!';

	// deleting a single article
	App\Article::destroy(3);
	return 'Destroyed!';
	/*
		UPDATING ARTICLES
	*/
	// updating multiple articles
	$articles = App\Article::where('id', '<', 3);
	$articles->update(array(
		'body' => 'test'
	));
	return 'Mass update!';

	// updating a single article
	$article = App\Article::find(3);
	$article->title = 'How to drive a car';
	$article->save();
	return 'Saved! New title is: '.$article->title;
	/*
		RETRIEVING ARTICLES
	*/
	// retieving a single article by ID 
	$article = App\Article::find(3);
	return $article->title;

	// retrieving multiple articles (like with QueryBuilder)
	$articles = App\Article::where('id', '>', 1)->get();
	foreach ($articles as $art) {
		var_dump($art->title);
	}
	return

	// retrieving all articles
	$articles = App\Article::all();
	foreach ($articles as $art) {
		var_dump($art->title);
	}
	return;
	/*
		CREATING NEW ARTICLES
	*/
	$article3 = App\Article::create(array(
		'title' => 'How to ride a bike',
		'body' => '...'
	));
	return;

	// second way (never a mass-assignment alert if done this way)
	$article2 = new App\Article();
	$article2->title = 'How to be succesful!';
	$article2->body = 'This is some other body...';
	$article2->save();
	return 'Saved article. It has an id of '.$article2->id;

	// first way
	$article = App\Article::create(array(
		'title' => 'How to peel potatoes',
		'body' => 'This is some body...'
	));
	return $article->id;
});

Route::get('article', function()
{
	$article = new App\Article('How to peel a potato');
	$letter = 'o';
	if ($article->containsLetter($letter)) {
		return 'Contains: '.$letter;
	}
	return 'Nope';
});

/************************************************************************************/

Route::get('conditional', function()
{
	$list = array('Harry', 'Ron', 'Hermione');
	return View::make('hello')->withFriends($list);
});

/**********************************************************************************/

Route::get('home_test', function () {
	 $name = DB::Connection()->getDatabaseName();
     return View::make('pages/home')->with('list', ['banana', 'pear', 'apple'])
     								->with('flavors', ['banana', 'pear', 'apple'])
     								->with('name', $name);
 });

Route::get('about', function () {
	/*
		General statements.
	*/
	//DB::statement("ALTER TABLE users ADD email VARCHAR(60)");
	//return 'Statement Succesful!';

	/*
		Deleting a user.
	*/
	//DB::delete("DELETE FROM users WHERE id = ?", array(4));
	//return 'Delete Succesful!';

	/*
		Updating an existing user.
	*/
	//DB::update("UPDATE users SET occupation = ? WHERE name = ?", array('Cook', 'Walter'));
	//return 'Update was Succesful!';

	/*
		Inserting a new user
	*/
	//DB::insert("INSERT INTO users (name, occupation) VALUES (?, ?)", array('Hank', 'DEA Officer'));
	//return 'Insert Succesful!';

	/*
		Grabbing a user's attributes.
	*/
	//$user = DB::selectOne("SELECT * FROM users WHERE id = 2");
	//return $user->name.' is an '.$user->occupation;

	/*
		Grabbing a single user.
	*/
	//$user = DB::selectOne("SELECT * FROM users WHERE id = 1");
	//dd($user);

	/*
		Grabbing all users.
	*/
	$users = DB::select("SELECT * FROM users2");
	var_dump($users);
    return View::make('pages/about');
 });

Route::get('contact', function () {
	// UPDATING/DELETING: ALWAYS SPECIFY THE WHERE CLAUSE
	//DB::table('users')->whereName('Mike')->delete();
	//return 'Deleted!';
	//DB::table('users')->whereId(1)->update(array('occupation' => 'Chemist'));
	//return 'Updated!';

	// INSERTING
	/*
		You can use insertGetId (insted of insert) to grab the id of the inserted user
		$id = DB::table('users')->insertGetId(array('name' => 'Mike', 'occupation' => 'Bodyguard'));
	*/
	//DB::table('users')->insert(array('name' => 'Mike', 'occupation' => 'Bodyguard'));
	//return 'Insert Succesful!';

	// SELECT * FROM users WHERE id = 2;
	/*
		Small note: you can use magic methods in your where clauses
		$user = DB::table('users')->whereOccupation('Lawyer')->first();
	*/
	//$user = DB::table('users')->where('id', 2)->first();//->where('id','>',2)->get()
	//dd($user);
	// SELECT * FROM users;
	//$users = DB::table('users')->get();
	//dd($users);
    return View::make('pages/contact');
 });

/***********************************************************************************/

Route::get('verify', function()
{
	return 'Form was submitted (using the GET method)!';
});
Route::post('verify', function()
{
	var_dump($_POST);
});

/***********************************************************************************/

Route::get('founds', function()
{
	$projects = DB::table('projects')->get();
	return View::make('founds')->with('projects', $projects);
});

Route::post('add', function()
{
	$name = Input::get('name');
	
	if (DB::table('projects')->whereName($name)->first() !== null) return 'Already Exists!';

	DB::table('projects')->insert(array('name' => $name));

	return Redirect::to('founds');
});

Route::post('donate', function()
{
	$donation = Input::get('donation');
	$id = Input::get('id');

	DB::table('projects')->where('id', $id)->increment('money', $donation);

	return Redirect::to('founds');
});

/*************************************************************************************/

Route::get('page1', function () {
    return 'page1 is a page';
});

// Route::get('page1/subpage1', function () {
//     return 'subpage1 is a subpage of page1';
// });

// Route::get('page1/{subpage}', function ($subpage) {
//     return $subpage.' is a subpage of page1';
// });

Route::get('page1/{subpage?}', function ($subpage = null) {
	if ($subpage == null) {
		return 'There is not a subpage of page1';
	}
    return $subpage.' is a subpage of page1';
});

Route::get('blog/{article?}', function ($article = null) {
	if ($article == null) {
		return 'This is a list of all articles....';
	}
	//check if title is in database
	//if not, return error page
    return 'This is the body of the article called '.$article;
});

Route::get('a/{par1}/b/{par2?}', function ($par1, $par2 = 'default') {
    return 'Param 1 is: '.$par1.' and param2 is: '.$par2;
});

/****************************************************************************/

// Passing a route parameter to your views
Route::get('test/{anything?}', function($anything = '')
{
	return View::make('hello')->with('var', $anything);
});
// Passing normal variables to your views
Route::get('passvar', function()
{
	$animal1 = 'Lion';
	$animal2 = 'Zebra';
	$capital1 = 'London';
	$capital2 = 'Paris';
	$list = array($animal1, $animal2, $capital1, $capital2);

	// Passing an array (may be easier than passing 100s of single variables)
	//return View::make('hello')->with('list', $list);

	// Magic Methods
	return View::make('hello')->withVar($animal1);

	// 2 ways of passing multiple variables
	// 2/2
	//return View::make('hello', array('var' => $animal2, 'cap' => $capital2));
	// 1/2
	//return View::make('hello')->with('var', $animal1)->with('cap', $capital1);

	// 2 ways of passing a single variable
	// 2/2
	//return View::make('hello', array('var' => $animal2));
	// 1/2
	//return View::make('hello')->with('someExoticVariableName', $animal1);
});
