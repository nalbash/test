<?php

namespace Nalbashgroup\NalbashBundle\Controller;

use Nalbashgroup\NalbashBundle\Entity\Coin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Coin controller.
 *
 * @Route("coin")
 */
class CoinController extends Controller
{
    /**
     * Lists all coin entities.
     *
     * @Route("/", name="coin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $coins = $em->getRepository('NalbashgroupNalbashBundle:Coin')->findAll();

        return $this->render('NalbashgroupNalbashBundle:coin:index.html.twig', array(
            'coins' => $coins,
        ));
    }

    /**
     * Creates a new coin entity.
     *
     * @Route("/new", name="coin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $coin = new Coin();
        $form = $this->createForm('Nalbashgroup\NalbashBundle\Form\CoinType', $coin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coin);
            $em->flush($coin);

            return $this->redirectToRoute('coin_show', array('id' => $coin->getId()));
        }

        return $this->render('NalbashgroupNalbashBundle:coin:new.html.twig', array(
            'coin' => $coin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a coin entity.
     *
     * @Route("/{id}", name="coin_show")
     * @Method("GET")
     */
    public function showAction(Coin $coin)
    {
        $deleteForm = $this->createDeleteForm($coin);

        return $this->render('NalbashgroupNalbashBundle:coin:show.html.twig', array(
            'coin' => $coin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing coin entity.
     *
     * @Route("/{id}/edit", name="coin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Coin $coin)
    {
        $deleteForm = $this->createDeleteForm($coin);
        $editForm = $this->createForm('Nalbashgroup\NalbashBundle\Form\CoinType', $coin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coin_edit', array('id' => $coin->getId()));
        }

        return $this->render('NalbashgroupNalbashBundle:coin:edit.html.twig', array(
            'coin' => $coin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a coin entity.
     *
     * @Route("/{id}", name="coin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Coin $coin)
    {
        $form = $this->createDeleteForm($coin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coin);
            $em->flush($coin);
        }

        return $this->redirectToRoute('coin_index');
    }

    /**
     * Creates a form to delete a coin entity.
     *
     * @param Coin $coin The coin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Coin $coin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coin_delete', array('id' => $coin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
