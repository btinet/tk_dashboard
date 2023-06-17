<?php

namespace App\Controller\Admin;

use App\Entity\Exam;
use App\Entity\ExamHasSchoolSubject;
use App\Entity\SchoolSubject;
use App\Menu\AdminMenu;
use App\Menu\MenuBuilder;
use App\Repository\SchoolSubjectRepository;
use Core\Component\DataStorageComponent\EntityManager;
use Core\Component\MenuComponent\AbstractMenu;
use Core\Controller\AbstractController;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

class DataImportController extends AbstractController
{

    protected AbstractRepositoryFactory $repository;

    private array $schoolSubjects;
    private AbstractMenu $adminMenu;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new SchoolSubjectRepository();
        $mainMenu = new MenuBuilder($this->session->getUser());
        $this->adminMenu = new AdminMenu($this->session->getUser());
        $mainMenu->createMenu();
        $this->schoolSubjects = $this->getRepositoryManager(SchoolSubject::class)->findAll(['label' => 'asc']);
        $this->getView()->addData([
            'schoolSubjects' => $this->schoolSubjects,
            'mainMenu' => $mainMenu->render(),
        ]);

        $this->denyAccessUnlessHasPermission('show_exam');
    }

    public function index(): string
    {
        $text = '';
        $file = [];
        if ($this->request->isPostRequest()) {
            $text = "POST\n";
            $row = 1;
            $file = $this->request->getFieldAsFile('csv_upload');
            if($file['type'] == 'application/vnd.ms-excel')
            {

                $em = new EntityManager();
                if (($handle = fopen($file['tmp_name'], "r")) != FALSE) {
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                        $exam = new Exam();


                        $exam->setKeyQuestion($data[0]);
                        $exam->setTopicId(1);
                        $exam->setYear($data[3]);
                        $id = $em->persist($exam);

                        $examHasSchoolSubject = new ExamHasSchoolSubject();
                        $examHasSchoolSubject->setExamId($id);
                        $examHasSchoolSubject->setUserId(NULL);
                        $examHasSchoolSubject->setSchoolSubjectId($this->repository->findOneBy(['abbr'=>$data[1]])->getId());
                        $examHasSchoolSubject->setIsMainSchoolSubject(1);
                        $em->persist($examHasSchoolSubject);

                        $examHasSchoolSubject = new ExamHasSchoolSubject();
                        $examHasSchoolSubject->setExamId($id);
                        $examHasSchoolSubject->setUserId(NULL);
                        $examHasSchoolSubject->setSchoolSubjectId($this->repository->findOneBy(['abbr'=>$data[2]])->getId());
                        $examHasSchoolSubject->setIsMainSchoolSubject(0);
                        $em->persist($examHasSchoolSubject);
                        $row++;
                    }
                    fclose($handle);
                }
            }else {
                $text = 'Keine CSV Datei!';
            }

        }

        $this->adminMenu->createMenu();
        return $this->render('admin/data_import/index.html',[
            'adminMenu' => $this->adminMenu->render(),
            'text' => $text,
            'file' => $file
        ]);
    }

}