const pool = require("../../config/database");

module.exports = {
  create: (data, callBack) => {
    pool.query(
      'INSERT INTO featured (item_table, item_id) VALUES (?, ?)',
      [data.item_table, data.item_id],
      (error, results) => {
        if (error) {
          return callBack(error);
        }
        return callBack(null, results);
      }
    );
  },

allFeatureds: (callBack) => {
    let quoteFeatures = []; // Store both featured_id and item_id for quotes
    let visualFeatures = []; // Store both featured_id and item_id for visuals
    let finalList = {};

    pool.query('SELECT id AS featured_id, item_id, item_table FROM featured', [], (error, results) => {
      if (error) {
        return callBack(error);
      }

      results.forEach(result => {
        if (result.item_table === 'quotes') {
          quoteFeatures.push({
            featured_id: result.featured_id,
            item_id: result.item_id
          });
        } else {
          visualFeatures.push({
            featured_id: result.featured_id,
            item_id: result.item_id
          });
        }
      });

      // Extract just the item_ids for the IN clause
      const quoteIds = quoteFeatures.map(f => f.item_id);
      const visualIds = visualFeatures.map(f => f.item_id);

      pool.query(
        'SELECT id, is_text, quote FROM quotes WHERE id IN (?)',
        [quoteIds.length ? quoteIds : [0]], 
        (error, quoteResults) => {
          if (error) {
            return callBack(error);
          }

          // Map featured_id to each quote result
          finalList['quoteList'] = quoteResults.map(quote => {
            const feature = quoteFeatures.find(f => f.item_id === quote.id);
            return {
              featured_id: feature ? feature.featured_id : null,
              ...quote
            };
          });

          pool.query(
            'SELECT id, category, image_path FROM visual_assets WHERE id IN (?)',
            [visualIds.length ? visualIds : [0]],
            (error, visualResults) => {
              if (error) {
                return callBack(error);
              }

              // Map featured_id to each visual result
              finalList['visualList'] = visualResults.map(visual => {
                const feature = visualFeatures.find(f => f.item_id === visual.id);
                return {
                  featured_id: feature ? feature.featured_id : null,
                  ...visual
                };
              });

              return callBack(null, finalList);
            }
          );
        }
      );
    });
  }
};
