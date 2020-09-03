<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookFormType;
use App\Render\RenderCalendar;
use App\Render\RenderCalendar2;
use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/calendar", name="admin_calendar")
     */
    public function calendar(CalendarRepository $calendar)
    {
        $calendaryear = $calendar->findBy(['year' => '2019']);
        //$cal = new RenderCalendar('2019', 3 ,11);
        $cal = new RenderCalendar2('2019', 3 ,11,$calendaryear);
        $year = getdate()['year'];

        return $this->render('admin/calendar.html.twig', [
            'controller_name' => 'Calendar',
            'test' => $cal,
            'year' => $year
        ]);
    }
    /**
     * @Route("/admin/getbook", name="admin_getbook")
     */
    public function getbook()
    {
        return $this->render('admin/JsonBook.html.twig', [
           
           
            
        ]);
    }
    /**
     * @Route("/admin/addbook", name="admin_addbook")
     */
    public function addbook()
    {
        $book = new Book();
        $form = $this->createForm(BookFormType::class,$book);
        return $this->render('admin/AddBook.html.twig', [
            'formBook' => $form->createView()
            
        ]);
    }
}
