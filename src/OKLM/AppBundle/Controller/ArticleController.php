<?php

namespace OKLM\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use OKLM\AppBundle\Entity\Article;
use OKLM\AppBundle\Form\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     */
    public function indexAction()
    {
        $entities = $this->getArticleManager()->getRepository()->findAll();

        return $this->render('OKLMAppBundle:Article:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createCreateForm($entity);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->getArticleManager()->create($entity);

                return $this->redirect($this->generateUrl('article_show', array('slug' => $entity->getSlug())));
            }
        }

        return $this->render('OKLMAppBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $entity)
    {
        $form = $this->createForm('oklm_appbundle_article', $entity, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OKLMAppBundle:Article')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('OKLMAppBundle:Article:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Article entity.
    *
    * @param Article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Article $entity)
    {
        $form = $this->createForm('oklm_appbundle_article', $entity, array(
            'action' => $this->generateUrl('article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var Article $entity
         */
        $entity = $em->getRepository('OKLMAppBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        if( true === in_array($request->getMethod(), ['POST', 'PUT'])) {
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $this->getArticleManager()->update($entity);

                return $this->redirect($this->generateUrl('article_show', array('slug' => $entity->getSlug())));
            }
        }

        return $this->render('OKLMAppBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OKLMAppBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $this->getArticleManager()->delete($entity);
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
 * @return ArticleManager
     */
    private function getArticleManager()
    {
        return $this->get('oklm_app.article.manager');
    }
}
