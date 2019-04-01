<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Auto;
use app\models\AutoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use yii\web\UploadedFile;

/**
 * AutoController implements the CRUD actions for Auto model.
 */
class AutoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Auto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Auto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Auto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auto(); // создается модель на которую action будет передовать данные, модель на прямую связана со строкой таблицы в БД
        /*if (Yii::$app->request->post()){ -проверяем есть ли данные отправлены то данные будут в суперглобальном массиве ПОСТ
            //var_dump($_POST); - Распечатываем массив ПОСТ без технологии Yii
            //var_dump(Yii::$app->request->post()); - Распичатываем массив ПОСТ который получаем Yii
            //echo $_POST['Auto']['name']; - Получаем значение конкретного поля формы
           ----------------------------------------------
            //$model->name=$_POST['Auto']['name']; - Передаем значение конкретному сойству модели
            //echo $model->name; - Выводим значение свойство модели которые подгружено но не добавлено в таблицу БД. если это сделать для всх свойств то мы заменим метод модели $model->load()
            //var_dump($model); - Распичатываем всю модель
            //$model->save(); - Сохраняем свойство модели в БД
            die; - Останавливаем работу скрипта5
        }*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Auto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Auto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Auto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSetImage($id) {
        //die("Загрузка картинки ".$id);
        $model= new ImageUpload;
        if (Yii::$app->request->isPost){
            $auto=$this->findModel($id);
            $file=UploadedFile::getInstance($model,'image');
            // var_dump($file->baseName); // получаем название файла без разширения
            //var_dump($file->extension); // получаем расширение файла
            // Добавляем уникальный индификатор к названию файла фуцией unigid
            // var_dump(strtolower(md5(uniqid($file->baseName)).".".$file->extension)); // md5 шыфрует уникальное название файла которое теперь приводим к нижнему регистру, strtolower делаем все маленьким регистром

            $auto->saveImage($model->imageUpload($file,$auto->photo)); // в сущности МОДЕЛИ АВТО создаем saveImage который сохранит название файла в БД переходим в models>Auto.php

         // print_r($file);
         // die;
            // после того как получили файл передаем его модели в которой создаем метод UploadImage($file)

        }
        return $this->render('image', ['model'=>$model]);
    }
}
