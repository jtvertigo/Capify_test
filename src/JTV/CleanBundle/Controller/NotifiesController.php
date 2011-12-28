<?php

namespace JTV\CleanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JTV\CleanBundle\Entity\Notifies;

use JTV\CleanBundle\Form\NotifiesType;
use JTV\CleanBundle\Form\QueryType;

/**
 * Notifies controller.
 *
 */
class NotifiesController extends Controller
{
    /**
     * Lists all Notifies entities.
     *
     * @Route("/", name="notifies")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JTVCleanBundle:Notifies')->findAll();

        $queryForm = $this->createForm(new QueryType());

        return array(
            'entities'  => $entities,
            'queryForm' => $queryForm->createView(),
        );
    }

    /**
     * Finds and displays a Notifies entity.
     *
     * @Route("/show/{id}", name="notifies_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JTVCleanBundle:Notifies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notifies entity.');
        }

        $queryForm = $this->createForm(new QueryType());
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'queryForm'   => $queryForm->createView(),    
        );
    }

    /**
     * Displays a form to create a new Notifies entity.
     *
     * @Route("/new", name="notifies_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Notifies();
        $form   = $this->createForm(new NotifiesType(), $entity);
        $queryForm = $this->createForm(new QueryType());

        return array(
            'entity'    => $entity,
            'form'      => $form->createView(),
            'queryForm' => $queryForm->createView(),
        );
    }

    /**
     * Creates a new Notifies entity.
     *
     * @Route("/create", name="notifies_create")
     * @Method("post")
     * @Template("JTVCleanBundle:Notifies:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Notifies();
        $request = $this->getRequest();
        $form    = $this->createForm(new NotifiesType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('notifies_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Notifies entity.
     *
     * @Route("/edit/{id}", name="notifies_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JTVCleanBundle:Notifies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notifies entity.');
        }

        $editForm = $this->createForm(new NotifiesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $queryForm = $this->createForm(new QueryType());

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'queryForm'   => $queryForm->createView(),
        );
    }

    /**
     * Edits an existing Notifies entity.
     *
     * @Route("/update/{id}", name="notifies_update")
     * @Method("post")
     * @Template("JTVCleanBundle:Notifies:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JTVCleanBundle:Notifies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notifies entity.');
        }

        $editForm   = $this->createForm(new NotifiesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('notifies_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Notifies entity.
     *
     * @Route("/delete/{id}", name="notifies_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JTVCleanBundle:Notifies')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Notifies entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('notifies'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Search logic
     * @Route("/search", name="notifies_search")
     * @Template()
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $queryForm = $this->createForm(new QueryType());

        if ($request->getMethod() == 'POST') {
            $queryForm = $this->createForm(new QueryType);
            $queryForm->bindRequest($request);

            $em = $this->getDoctrine()->getEntityManager();

            $data = $queryForm->getData(); //get data from $_POST

            $ent = $this->getDoctrine()->getEntityManager()
                ->getConnection()
                ->prepare('SELECT * FROM Notifies WHERE date_format(dt, \'%d.%m.%Y\') = :date');
            $ent->bindValue('date', $data['query']);
            $ent->execute();
            $entity = $ent->fetchAll();

            return array(
                'date'       => $data['query'],  
                'entity'     => $entity, 
                'queryForm'  => $queryForm->createView(),
            );
        }

        return array(
            'queryForm' => $queryForm->createView(),
        );
    }
}
