import {
	useBlockProps,
	MediaUpload,
	MediaUploadCheck,
	InspectorControls,
} from "@wordpress/block-editor";
import {
	Button,
	PanelBody,
	TextControl,
	SelectControl,
} from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { Fragment, useState } from "react";
import { useSelect } from "@wordpress/data";
import Slider from "react-slick";
import "./editor.scss";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

export default function Edit({ attributes, setAttributes, isSelected }) {
	const { imageDetails, blockTitle, furtherInfoLink, ctaTitle } = attributes;
	const blockProps = useBlockProps();
	const [selectedCardIndex, setSelectedCardIndex] = useState(null); // Track which card is selected

	// Function to add a new card to the carousel
	const handleAddCard = () => {
		const newCard = {
			mediaURL: "",
			mediaId: null,
			cardTitle: "",
			pageLink: "",
		};
		setAttributes({ imageDetails: [...imageDetails, newCard] });
		setSelectedCardIndex(imageDetails.length); // Automatically select the new card
	};

	// Function to update card details (image, title, link)
	const updateCardDetail = (index, key, value) => {
		const updatedCards = [...imageDetails];
		updatedCards[index][key] = value;
		setAttributes({ imageDetails: updatedCards });
	};

	// Function to remove a card from the carousel
	const handleRemoveCard = (index) => {
		const updatedCards = [...imageDetails];
		updatedCards.splice(index, 1);
		setAttributes({ imageDetails: updatedCards });
		setSelectedCardIndex(null); // Reset selected card when a card is removed
	};

	// Function to select a card
	const handleCardClick = (index) => {
		setSelectedCardIndex(index);
	};

	// Fetching Pages using useSelect hook
	const pages = useSelect((select) => {
		return select("core").getEntityRecords("postType", "page", {
			per_page: -1, // Fetch all pages
		});
	}, []);

	// Creating options for the page selection dropdown
	const pageOptions = [
		{ label: __("Select a Page", "image-carousel"), value: "" }, // Default empty option
		...(pages
			? pages.map((page) => ({
					label: page.title.rendered,
					value: page.link, // Use the link of the page
			  }))
			: []),
	];

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__("Card Settings", "image-carousel")}
					initialOpen={true}
				>
					<TextControl
						label={__("Block Title", "image-carousel")}
						value={blockTitle}
						onChange={(value) => setAttributes({ blockTitle: value })}
					/>
					<TextControl
						label={__("Page Link Title", "image-carousel")}
						value={ctaTitle}
						onChange={(value) => setAttributes({ ctaTitle: value })}
					/>
					<SelectControl
						label={__("Select a Page Link", "image-carousel")}
						options={pageOptions}
						value={furtherInfoLink}
						onChange={(value) => setAttributes({ furtherInfoLink: value })}
					/>
				</PanelBody>
			</InspectorControls>
			{isSelected && selectedCardIndex !== null && (
				<InspectorControls>
					<PanelBody
						title={
							__("Card Settings", "image-carousel") +
							` ${selectedCardIndex + 1}`
						}
						initialOpen={true}
					>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) =>
									updateCardDetail(selectedCardIndex, "mediaURL", media.url)
								}
								allowedTypes={["image"]}
								render={({ open }) => (
									<Button onClick={open} variant="secondary" isSecondary>
										{__("Select Image", "image-carousel")}
									</Button>
								)}
							/>
						</MediaUploadCheck>
						{imageDetails[selectedCardIndex]?.mediaURL && (
							<img
								className="image-carousel__preview"
								src={imageDetails[selectedCardIndex].mediaURL}
								alt={__("Selected Image", "image-carousel")}
								style={{ width: "100%", marginBottom: "10px" }}
							/>
						)}
						<TextControl
							label={__("Card Title", "image-carousel")}
							value={imageDetails[selectedCardIndex]?.cardTitle}
							onChange={(value) =>
								updateCardDetail(selectedCardIndex, "cardTitle", value)
							}
						/>
						<SelectControl
							label={__("Select a Page Link", "image-carousel")}
							value={imageDetails[selectedCardIndex]?.pageLink}
							options={pageOptions}
							onChange={(newLink) => {
								updateCardDetail(selectedCardIndex, "pageLink", newLink);
							}}
						/>
						<Button
							isDestructive
							onClick={() => handleRemoveCard(selectedCardIndex)}
						>
							{__("Remove Card", "image-carousel")}
						</Button>
					</PanelBody>
				</InspectorControls>
			)}

			<section {...blockProps}>
				<h2>{blockTitle}</h2>
				<Button
					variant="primary"
					onClick={handleAddCard}
					style={{ marginBottom: "20px" }}
				>
					{__("Add Card", "image-carousel")}
				</Button>

				{imageDetails.length === 0 ? (
					<p>{__("No cards added.", "image-carousel")}</p>
				) : (
					<Slider
						dots={false}
						infinite={false}
						slidesToShow={4.5}
						slidesToScroll={1}
					>
						{imageDetails.map((card, index) => (
							<div
								key={index}
								onClick={() => handleCardClick(index)} // Set selected card on click
								style={{
									border:
										selectedCardIndex === index ? "2px solid #007cba" : "none", // Highlight selected card
									cursor: "pointer",
								}}
							>
								<div className="image-carousel__card">
									<div className="image-carousel__card-inner">
										<img
											src={card.mediaURL || "https://via.placeholder.com/300"}
											alt={card.cardTitle || __("No Title", "image-carousel")}
										/>
									</div>
									<div className="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
										<div className="wp-block-button shorter is-style-outline">
											<a
												href={card.pageLink}
												className="wp-block-button__link wp-element-button"
											>
												{card.cardTitle || __("Untitled", "image-carousel")}
											</a>
										</div>
									</div>
								</div>
							</div>
						))}
					</Slider>
				)}
				<div className="blockCta">
					<div className="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
						<div className="wp-block-button shorter is-style-outline">
							<a
								href={furtherInfoLink}
								className="wp-block-button__link wp-element-button"
							>
								{ctaTitle}
							</a>
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
