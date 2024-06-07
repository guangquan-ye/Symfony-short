<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use App\Form\DataTransformer\JsonToArrayTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
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
            ->add(
                $builder->create('data', null, ['compound' => true])
                    ->add('message_content', TextType::class, [
                        'required' => false,
                    ])
                    ->add('image_src', TextType::class, [
                        'required' => false,
                    ])
                    ->add('image_alt', TextType::class, [
                        'required' => false,
                    ])
                    ->add('video_src', TextType::class, [
                        'required' => false,
                    ])
                    ->add('video_alt', TextType::class, [
                        'required' => false,
                    ])
                    ->addModelTransformer($this->jsonToArrayTransformer)
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
