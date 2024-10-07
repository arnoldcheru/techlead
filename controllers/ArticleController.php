<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */

    

     public function behaviors()
     {
         return array_merge(
             parent::behaviors(),
             [
                 'access' => [
                     'class' => AccessControl::class,
                     'rules' => [
                         [
                             'actions' => ['login'], // Allow guests to access the login action
                             'allow' => true,
                             'roles' => ['?'], // Only guests
                         ],
                         [
                             'actions' => ['index', 'view','create','delete'], // Actions for authenticated users
                             'allow' => true,
                             'roles' => ['@'], // Only authenticated users
                         ],
                         [
                             'actions' => ['logout'], // Allow authenticated users to logout
                             'allow' => true,
                             'roles' => ['@'],
                         ],
                     ],
                 ],
                 'verbs' => [
                     'class' => VerbFilter::class,
                     'actions' => [
                         'delete' => ['POST'],
                     ],
                 ],
             ]
         );
     }
     
    /**
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id = null)
{
    if ($id === null) {
        // Set a default ID, e.g., the latest article
        $model = Article::find()->orderBy(['created_at' => SORT_DESC])->one();
        if ($model !== null) {
            $id = $model->id;
        } else {
            throw new NotFoundHttpException("No articles found.");
        }
    } else {
        $model = Article::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Article not found.");
        }
    }

    return $this->render('view', [
        'model' => $model,
    ]);
}


    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Check if the user is logged in
        if (Yii::$app->user->isGuest) {
            // Redirect to the login page
            return $this->redirect(['site/login']);
        }

        $model = new Article();

        // Load data and save the article if the user is logged in
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->created_by !== Yii::$app->user->id){
            throw new ForbiddenHttpException('You do not have permission to update this article');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
{
    // Find the model or throw a 404 error
    $model = $this->findModel($id);

    // Check if the current user has permission to delete the article
    if ($model->created_by !== Yii::$app->user->id) {
        throw new ForbiddenHttpException('You do not have permission to delete this article.');
    }

    // Use a transaction for safe deletion
    $transaction = Yii::$app->db->beginTransaction();
    try {
        $model->delete();
        $transaction->commit();
        
        // Set a flash message for user feedback
        Yii::$app->session->setFlash('success', 'Article deleted successfully.');
    } catch (\Exception $e) {
        $transaction->rollBack();
        Yii::$app->session->setFlash('error', 'Error deleting article: ' . $e->getMessage());
    }

    // Redirect to the index page
    return $this->redirect(['index']);
}


    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
