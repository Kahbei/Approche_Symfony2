<?php

namespace OKLM\AppBundle\Controller;

use OKLM\AppBundle\CommentManager\CommentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use OKLM\AppBundle\Entity\Comment;
use OKLM\AppBundle\Form\CommentType;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{

    /**
     * Lists all Comment entities.
     *
     */
    public function indexAction()
    {
        $entities = $this->getCommentManager()->getRepository()->findAll();

        return $this->render('OKLMAppBundle:Comment:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Comment entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Comment();
        $form = $this->createCreateForm($entity);

        if('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->getCommentManager()->create($entity);

                return $this->redirect($this->generateUrl('comment_show', array('id' => $entity->getId())));
            }
        }

        return $this->render('OKLMAppBundle:Comment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Comment entity.
     *
     * @param Comment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Comment $entity)
    {
        $form = $this->createForm('oklm_appbundle_comment', $entity, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Comment entity.
     *
     */
    public function showAction($id)
    {
        $entity = $this->getCommentManager()->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OKLMAppBundle:Comment:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Comment entity.
    *
    * @param Comment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Comment $entity)
    {
        $form = $this->createForm('oklm_appbundle_comment', $entity, array(
            'action' => $this->generateUrl('comment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Comment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getCommentManager()->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        if(true === in_array($request->getMethod(), ['POST', 'PUT'])){
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $this->getCommentManager()->update($entity);

                return $this->redirect($this->generateUrl('comment_update', array('id' => $id)));
            }
        }


        return $this->render('OKLMAppBundle:Comment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Comment entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->getCommentManager()->getRepository()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $this->getCommentManager()->delete($entity);
        }

        return $this->redirect($this->generateUrl('comment'));
    }

    /**
     * Creates a form to delete a Comment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * @return CommentManager
     */
    private function getCommentManager(){
        return $this->get('oklm_app.comment.manager');
    }
}
