
<?
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

class AppController extends Controller
{
    // Chook
     public function beforeAction($action)
    {
        $this->view->title = \Yii::$app->name; // выводит 'name' - название сайта, зарегистрироован в config/web.php
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
     // View - это объект, выполняющий функцию представления данных в MVC шаблоне. Представление по умолчанию настроено как 'компонент вида' приложения в yii\base\Application. 
     // Вы можете получить доступ к этому экземпляру через Yii::$app->view.
     // функция объяления метатегов для всех страниц сайта, реализуется через обращение к компоненту view "Class yii\web\View" и его публичнчному методу 'registerMetaTag'
    // метод (функция) теперь может использоваться в экшенах (action) конироллеров
     protected function setMeta($title = null, $keywords = null, $description = null) // в скобках передаваемые параметры, метатеги
    {
        $this->view->title = $title; // $title - это то, что передаётся при вызове метода setMeta
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }
    
    /**
     * Logout action.
     *
     * @return Response
     **/
    public function actionBlog()
    {
        Yii::$app->user->logout();

        return $this->render('blog');
    }

    
}
