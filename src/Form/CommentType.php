<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Form\DataTransformer\JsonToArrayTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    private JsonToArrayTransformer $jsonToArrayTransformer;

    public function __construct(JsonToArrayTransformer $jsonToArrayTransformer)
    {
        $this->jsonToArrayTransformer = $jsonToArrayTransformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('id_post', EntityType::class, [
                'class' => Post::class,
                'choice_label' => 'id',
            ])
            ->add(
                $builder->create('data', null, ['compound' => true])
                    ->add('comment_message_content', TextType::class, [
                        'required' => false,
                    ])
                    ->add('comment_image_src', TextType::class, [
                        'required' => false,
                    ])
                    ->add('comment_image_alt', TextType::class, [
                        'required' => false,
                    ])
                    ->add('comment_video_src', TextType::class, [
                        'required' => false,
                    ])
                    ->add('comment_video_alt', TextType::class, [
                        'required' => false,
                    ])
                    ->addModelTransformer($this->jsonToArrayTransformer)
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
